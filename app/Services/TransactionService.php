<?php

namespace App\Services;

use App\Models\Pool;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Class TransactionService
 * @package App\Services
 */
class TransactionService
{
    /**
     * @var PaymentService
     */
    private $payment;

    public function __construct(PaymentService $paymentService)
    {
        $this->payment = $paymentService;
    }

    public function create(
        Pool $pool,
        User $contributor,
        float $amount = 0,
        string $currency_pack = 'eth::ETH',
        string $chainID = NULL
    )
    {
        $res = [];

        $scope = Str::uuid();
        $attributes = [];

        try {
            $currency = currency_info($currency_pack);
        } catch(\Exception $e) {
            $attributes['status'] = app(Transaction::class)->getStatusIdByKey('canceled');
            $attributes['errors'] = $e->getMessage();
            $res['error'] = Transaction::create($attributes);

            return $res;
        }

        list($total,$commission,$fee) = $this->calculate_commission(
            $amount,
            $pool
        );

        $attributes['currency'] = $currency_pack;
        $attributes['chainid'] = $currency['chainId'] ?? NULL;
        $attributes['contributor_id'] = $contributor->id;
        $attributes['contributor_account'] = $contributor->auth_address;

        $attributes['pool_id'] = $pool->id;
        $attributes['status'] = app(Transaction::class)->getStatusIdByKey('draft');

        $attributes['commission'] = $commission;
        $attributes['fee'] = $fee;
        $attributes['scope'] = $scope;

        $attributes['contributed'] = $pool->contributed;
        $attributes['contributed_usd'] = $pool->contributed_usd;

        DB::beginTransaction();
        try {
            $attributes['destination_account'] = config('oxo.payment.fee.account');
            if($fee > 0 && !empty($attributes['destination_account'])) {
                $attributes['amount'] = $this->payment->convertToETH($currency['currency']['symbol'], $commission);
                $attributes['amount_native'] = $commission;
                $attributes['amount_usd'] = $this->payment->convertToUSD($currency['currency']['symbol'], $commission);
                $attributes['destination'] = 'fee';
                $attributes['invested'] = 0;
                $res['fee'] = Transaction::create($attributes);
            }

            $attributes['amount'] = $this->payment->convertToETH($currency['currency']['symbol'],$total);
            $attributes['amount_native'] = $total;
            $attributes['amount_usd'] = $this->payment->convertToUSD($currency['currency']['symbol'],$total);
            $attributes['invested'] = $attributes['amount_usd'];
            $attributes['destination'] = 'pool';
            $attributes['destination_account'] = $pool->address;
            $attributes['collect'] = $this->collect_data($contributor, $pool);

            $res['main'] = Transaction::create($attributes);

            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            $res = [];

            DB::rollBack();

            $attributes['status'] = app(Transaction::class)->getStatusIdByKey('canceled');
            $attributes['errors'] = $e->getMessage();
            $res['error'] = Transaction::create($attributes);
        }
        return $res;
    }

    private function calculate_commission(float $amount, Pool $pool):array {
        $fee = $pool->rules[0]['fee'] ?? 0;
        if(function_exists('bcmul'))
            $commission = bcmul($amount,$fee/100);
        else
            $commission = $amount * $fee/100;

        $total = $amount-$commission;

        return [$total,$commission,$fee];
    }

    private function collect_data(User $contributor, Pool $pool):array {
        $collect = [];
        foreach ($pool->collect as $field) {
            switch($field) {
                case 'email':
                    $collect['email'] = $contributor->email;
                    break;
                case 'birthday':
                    $collect['birthday'] = $contributor->birthday;
                    break;
                case 'name':
                    $collect['name'] = $contributor->name;
                    break;
                case 'surname':
                    $collect['surname'] = $contributor->surname;
                    break;
            }
        }

        return $collect;
    }

    public function runTransaction(Transaction $transaction)
    {
        Log::debug('runTransaction',[$transaction]);


        if($transaction->destination != 'pool') {
            return false;
        }

        DB::beginTransaction();
        try {
            if($transaction->status != $transaction->getStatusIdByKey('pending')) return false;

            $pool = $transaction->pool;
            Transaction::where('scope','=',$transaction->scope)->update([
                'status' => $transaction->getStatusIdByKey('completed')
            ]);

            $pool->contributed += $transaction->amount;
            $pool->contributed_usd += $transaction->invested;
            $pool->progress = $pool->amount_usd!=0 ? $pool->contributed_usd/$pool->amount_usd * 100 : 0;
            if($pool->contributed_usd == 0 && $pool->contributed > 0) { // can't convert currency to usd, calculating in native
                $pool->progress = $pool->amount_usd!=0 ? $pool->contributed/$pool->amount * 100 : 0;
            }
            $pool->save();

            $owner = $pool->owner;
            $owner->invested += $transaction->amount; //ETH
            $owner->invested_usd += $transaction->invested;
            $owner->save();

            $contributor = $transaction->contributor;
            $contributor->contributed += $transaction->amount; //ETH
            $contributor->contributed_usd += $transaction->invested;
            $contributor->save();

            DB::commit();

            $result = true;
        } catch (Exception $e) {
            DB::rollBack();

			Log::error($e);
            $result = false;

			throw $e;
        }

        return $result;
    }

    public function rollbackTransaction(Transaction $transaction): bool
    {
		Log::debug('rollbackTransaction',[$transaction]);
        $result = false;

        DB::beginTransaction();
        try {
            if($transaction->status != $transaction->getStatusIdByKey('completed')) return false;

            $pool = $transaction->pool;
            Transaction::where('scope','=',$transaction->scope)
            ->update([
                'status' => $transaction->getStatusIdByKey('returned')
            ]);

            $pool->contributed -= $transaction->amount;
            $pool->contributed_usd -= $transaction->invested;
            $pool->progress = $pool->amount!=0 ? $pool->contributed/$pool->amount * 100 : 0;
            if($pool->contributed_usd == 0 && $pool->contributed > 0) { // can't convert currency to usd, calculating in native
                $pool->progress = $pool->amount_usd!=0 ? $pool->contributed/$pool->amount * 100 : 0;
            }
            $pool->save();

            $owner = $pool->owner;
            $owner->invested -= $transaction->amount;
            $owner->invested_usd -= $transaction->invested;
            $owner->save();

            $contributor = $transaction->contributor;
            $contributor->contributed -= $transaction->amount;
            $contributor->contributed_usd -= $transaction->invested;
            $contributor->save();

            DB::commit();

            $result = true;
        } catch (\Exception | \Error $e) {
			Log::error('rollbackTransaction',[$e]);
            DB::rollBack();

			$transaction->update([
				'errors' => $e->getMessage()
			]);
        }

        return $result;
    }
}
