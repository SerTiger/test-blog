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
    public function create(
        Pool $pool,
        User $contributor,
        float $amount = 0,
        string $currency = 'ETH',
        string $chainID = NULL
    )
    {
        $res = [];

        $scope = Str::uuid();
        list($total,$commission,$fee) = $this->calculate_commission($amount, $pool);

        $attributes = [];
        $attributes['contributor_id'] = $contributor->id;
        $attributes['contributor_account'] = $contributor->auth_address;

        $attributes['pool_id'] = $pool->id;
        $attributes['status'] = app(Transaction::class)->getStatusIdByKey('pending');

        $attributes['commission'] = $commission;
        $attributes['fee'] = $fee;
        $attributes['scope'] = $scope;
        $attributes['currency'] = $currency;
        $attributes['contributed'] = $pool->contributed;

        DB::beginTransaction();
        try {
            $attributes['amount'] = $commission;
            $attributes['destination'] = 'fee';
            $attributes['invested'] = 0;
            $attributes['destination_account'] = config('oxo.payment.fee.account');
            if($fee > 0) $res['fee'] =  Transaction::create($attributes);

            $attributes['amount'] = $total;
            $attributes['invested'] = $total;
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
        $result = false;

        if($transaction->destination != 'pool') {
            return false;
        }

        DB::beginTransaction();
        try {

            $pool = $transaction->pool;
            Transaction::where('scope','=',$transaction->scope)->update([
                'status' => $transaction->getStatusIdByKey('completed')
            ]);

            $pool->contributed += $transaction->amount;
            $pool->progress = $pool->amount!=0 ? $pool->contributed/$pool->amount * 100 : 0;
            $pool->save();

            DB::commit();

            $result = true;
        } catch (Exception $e) {
            DB::rollBack();

			Log::error($e);

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

            $pool = $transaction->pool;
            Transaction::where('scope','=',$transaction->scope)->update([
                'status' => $transaction->getStatusIdByKey('returned')
            ]);

            $pool->contributed -= $transaction->amount;
            $pool->progress = $pool->amount!=0 ? $pool->contributed/$pool->amount * 100 : 0;
            $pool->save();

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
