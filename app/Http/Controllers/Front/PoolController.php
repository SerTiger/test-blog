<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pool;
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
            $pool->update(['image' => NULL]);
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

        $this->data('pool',$pool);
        $this->data('filter',['transaction_status'=>$request->get('of',NULL)]);

        return $this->render('pool.pool');
    }

    public function page($uuid)
    {
        $user = auth()->user();

        $pool = Pool::where('uuid',$uuid)->first();

        if(!$pool) abort(404);

        $this->data('pool',$pool);

        return $this->render('pub.pool');
    }

    public function signature(Request $request, Web3Auth $auth) {
        return $auth->signature($request);
    }

    public function transaction($uuid, Request $request, TransactionService $transactionService, Web3Auth $auth)
    {
        $user = auth()->user();

        //$auth->verifySignature($user->auth_address, $request);

        $pool = Pool::where('uuid',$uuid)->first();

        if(!$pool) abort(404);

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
                'link'=>NUll
            ]);
        }

        return response()->json([
            'transactions'=> collect($result)->map(function ($item, $key) {
                return [
                    'amount' => $item->amount,
                    'from' => $item->contributor_account,
                    'to' => $item->destination_account,
                    'type' => $item->destination,
                    'scope' => $item->scope
                ];
            }),
            'link'=>route('pool.transaction.sign',$uuid)
        ]);
        //return redirect()->route('contribution.index');
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
