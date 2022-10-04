<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pool;
use App\Models\Transaction;
use App\Services\PaymentService;
use App\Services\TransactionService;
use App\Services\Web3Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PoolController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();

        $this->data('pools', $user->pools);

        return $this->render('pool.pools');
    }

    public function create(Request $request)
    {
        $this->data('pool', NULL);

        return $this->render('pool.create_pool');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $pool = $user->pools()->findOrNew($request->get('id'));

        $dto = $request->all();
        $dto['company_id'] = $user->company->id;

        $old_image = $pool->image;

        $pool->fill($dto);
        $rules = [];
        foreach ($dto['rules'] as $rule_str)
            $rules[] = json_decode($rule_str);
        $pool->rules = $rules;

        $rules = collect($rules);
        $pool->start_date = $rules
            ->pluck('start_date')
            ->map(function($date) {
                return carbon($date);
            })->min();
        $pool->end_date = $rules
            ->pluck('end_date')
            ->map(function($date) {
                return carbon($date);
            })->max();

        $pool->save();

        if ($request->file('image')) {
            $image = Storage::disk('files')->putFile(
                'pools/' . $pool->id,
                $request->file('image')
            );
            $pool->update(['image' => Storage::disk('files')->url($image)]);
        } else {
            if($request->get('image_cleared', false)) {
                $pool->update(['image' => NULL]);
            } else {
                $pool->update(['image' => $old_image]);
            }
        }

        return $request->ajax()
            ? response()->json(['redirect' => route('company.pools')])
            : redirect()->route('company.pools');
    }

    public function edit($uuid, Request $request)
    {
        $user = auth()->user();

        $pool =  $user->pools()->where('uuid',$uuid)->first();

        if(!$pool) abort(404);

        $this->data('pool',$pool);

        return $this->render('pool.create_pool');
    }

    public function start($uuid, Request $request, Web3Auth $auth) {
        $verify = $auth->verifySignature($request->get('address'),$request);

        if(!$verify) return abort(403);

        $user = auth()->user();

        $pool =  $user->pools()->where('uuid',$uuid)->first();

        if(!$pool) abort(404);

        $pool->status = $pool->getStatusIdByKey('active');
        $pool->save();

        return $request->ajax()
            ? response()->json(['redirect' => route('pool.show',$uuid)])
            : redirect()->route('pool.show',$uuid);
    }

    public function stop($uuid, Request $request, Web3Auth $auth) {
        $verify = $auth->verifySignature($request->get('address'),$request);

        if(!$verify) return abort(403);

        $user = auth()->user();

        $pool =  $user->pools()->where('uuid',$uuid)->first();

        if(!$pool) abort(404);

        $pool->status = $pool->getStatusIdByKey('pause');
        $pool->save();

        return $request->ajax()
            ? response()->json(['redirect' => route('pool.show',$uuid)])
            : redirect()->route('pool.show',$uuid);
    }

    public function show($uuid, Request $request)
    {
        $user = auth()->user();

        $pool =  $user->pools()->where('uuid',$uuid)->first();

        if(!$pool) abort(404);

        $filter = ['transaction_status'=>$request->get('of',NULL)];

        $pool->load(['transactions'=>function($q) use ($filter) {
            return $q
                ->when($filter['transaction_status'],function($q)  use ($filter) {
                    return $q->whereIn('status', explode(',',$filter['transaction_status']));
                });
        }]);

        $this->data('pool',$pool);
        $this->data('filter',$filter);

        return $this->render('pool.pool');
    }

    public function page($uuid)
    {
        $user = auth()->user();

        $pool = Pool::where('uuid',$uuid)->first();

        if(!$pool) abort(404);

        if( $pool->getStringStatus() !== 'active') {
            return $this->render('pub.ended');
        }

        $this->data('pool',$pool);

        return $this->render('pub.pool');
    }

    public function signature(Request $request, Web3Auth $auth) {
        return $auth->signature($request);
    }

    public function transaction($uuid, Request $request, PaymentService $paymentService, TransactionService $transactionService)
    {
        $user = auth()->user();

        //$auth->verifySignature($user->auth_address, $request);

        $pool = Pool::where('uuid',$uuid)->first();

        if(!$pool) abort(404);

        list($pool_network,$pool_currency) = explode('::',$pool->currency);
        list($tx_network,$tx_currency) = explode('::',$request->get('currency'));
        $error = '';
        $tx_amount_usd = $paymentService->convertToUSD($tx_currency,(float)$request->get('amount',0));
        $pool_min_amount_usd = $paymentService->convertToUSD($pool_currency, (float)$pool->rules[0]['min_single']);
        if($pool_min_amount_usd > $tx_amount_usd) $error = "Too small amount";
        $pool_max_amount_usd = $paymentService->convertToUSD($pool_currency, (float)$pool->rules[0]['max_single']);
        if($pool_max_amount_usd < $tx_amount_usd) $error = "Too big amount";

        $pool_multiples = $pool->rules[0]['amount_multiples'] ?? 0;
        if($pool_multiples > 0 && $request->get('amount') % $pool_multiples != 0 ) $error = "Not allowed amount";

        $max_tx = $pool->rules[0]['contribute_counter'] ?? 0;
        $user_tx = $pool->transactions()->where('contributor_id','=',$user->id)->count();
        if($max_tx > 0 && $user_tx >= $max_tx) $error = "Pool transaction limit reached";

        if( !empty($error) )
            return response()->json([
                'transactions'=>NULL,
                'error'=>$error,
                'link'=>NUll
            ]);

        if( $request->get('amount',0) )

        $result = $transactionService->create(
            $pool,
            $user,
            $request->get('amount',0),
            $request->get('currency'),
            $user->wallets()->where('address',$user->auth_address)->first()->chainid
        );

        if(!empty($result['error'])) {
            return response()->json([
                'transactions'=>NULL,
                'error'=>'Error occurred!',
                'link'=>NUll
            ]);
        }

        return response()->json([
            'transactions'=> collect($result)->map(function ($item, $key) {
                return [
                    'amount' => $item->chainid ? $item->amount_native : $item->amount,
                    'from' => $item->contributor_account,
                    'to' => $item->destination_account,
                    'type' => $item->destination,
                    'scope' => $item->scope,
                    'chainId' => dechex($item->chainid ?? 1), // eth
                ];
            }),
            'link'=>route('pool.transaction.confirm',$uuid)
        ]);
    }

    public function rollback($scope, Request $request)
    {
        $user = auth()->user();

        //$auth->verifySignature($user->auth_address, $request);

        $item = Transaction::query()
            ->where('destination','=','pool')
            ->where('scope','=',$scope)
            ->first();

        $pool = Pool::where('id','=',$item->pool_id)->where('owner_id','=',$user->id)->first();

        if(!$pool) abort(404);

        if(!empty($item->revert_txHash)) {
            return response()->json([
                'transactions'=>NULL,
                'error'=>'Rollback not allowed',
                'link'=>NUll
            ]);
        }

        return response()->json([
            'transactions'=> [
                'main'=>[
                    'amount' => $item->amount_native,
                    'to' => $item->contributor_account,
                    'from' => $item->destination_account,
                    'type' => $item->destination,
                    'scope' => $item->scope,
                    'chainId' => dechex($item->chainid), // eth
                ],
            ],
            'link'=>route('pool.transaction.revert',$item->scope)
        ]);
    }

    public function transaction_confirm($uuid, Request $request, TransactionService $transactionService)
    {
        $user = auth()->user();

        $pool = Pool::where('uuid',$uuid)->first();

        if(!$pool) abort(404);

        $txDTO = $request->only('txHash','amount','scope','type','address');

        if( ! $transactionService->confirm($user, $pool, $txDTO) ){
            abort(423);
        }

        return response()->json([
            'link'=>route('pool.transaction.await',[$txDTO['scope']])
        ]);
    }

    public function transaction_revert($scope, Request $request, TransactionService $transactionService)
    {
        $user = auth()->user();

        //$auth->verifySignature($user->auth_address, $request);

        $item = Transaction::query()
            ->where('destination','=','pool')
            ->where('scope','=',$scope)
            ->first();

        $pool = Pool::where('id','=',$item->pool_id)->where('owner_id','=',$user->id)->first();

        if(!$pool) abort(404);

        $txDTO = $request->only('txHash','amount','scope','type','address');

        if( ! $transactionService->revert($pool, $txDTO) ){
            abort(423);
        }

        return response()->json([]);
    }

    public function transaction_await($scope, Request $request)
    {
        $user = auth()->user();

        $transactions = $user->contributions()
            ->pending()->withFee()
            ->where('scope','=',$scope)
            ->get();

        if(!$transactions) abort(404);

        $this->data('amount', $transactions->sum('amount_native'));
        $this->data('transaction',$transactions->where('destination','=','pool')->first());

        return $this->render('pub.await');
    }

    public function transaction_notify($scope, Request $request)
    {
        $user = auth()->user();

        $transactions = $user->contributions()
            ->pending()->withFee()
            ->where('scope','=',$scope)
            ->get();

        if(!$transactions) abort(404);

        $user->contributions()
            ->pending()->withFee()
            ->where('scope','=',$scope)
            ->update([
                'confirmation' => json_encode(['email'=>$request->get('email')])
            ]);

        // MailSend

        return redirect()->route('pool.transaction.await',$scope);
    }

    public function update($uuid, Request $request)
    {
        $user = auth()->user();

        $dto = $request->all();
        $dto['company_id'] = $user->company->id;

        $pool = $user->pools()->where('uuid','=',$uuid)->first();
        if(!$pool)
            abort(404);

        $pool->fill($dto);
        $rules = [];
        foreach ($dto['rules'] as $rule_str)
            $rules[] = json_decode($rule_str);
        $pool->rules = $rules;

        $rules = collect($rules);
        $pool->start_date = $rules
            ->pluck('start_date')
            ->map(function($date) {
                return carbon($date);
            })->min();
        $pool->end_date = $rules
            ->pluck('end_date')
            ->map(function($date) {
                return carbon($date);
            })->max();

        $pool->save();

        if ($request->file('image')) {
            $image = Storage::disk('files')->putFile(
                'pools/' . $pool->id,
                $request->file('image')
            );
            $pool->update(['image' => Storage::disk('files')->url($image)]);
        }

        return $request->ajax()
            ? response()->json(['redirect' => route('company.pools')])
            : redirect()->route('company.pools');
    }
}
