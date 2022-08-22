<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pool;
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
            $pool->update(['image' => $image]);
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
            $pool->update(['image' => $image]);
        }

        return $request->ajax()
            ? response()->json(['redirect' => route('company.pools')])
            : redirect()->route('company.pools');
    }
}
