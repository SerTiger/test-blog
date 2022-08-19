<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $user = auth()->user();

        $company = $user->company;

        if($company) {
            return redirect()->route(config('oxo.homepage.auth'));
        }

        $dto = $request->all();
        $company = $user->company()->create($dto);

        $logo = Storage::disk('files')->putFile(
            $company->id,
            $request->file('logo')
        );
        $user->company()->update(['logo' => $logo]);

        return redirect()->route(config('oxo.homepage.auth'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $company = $user->company;

        if($company) {
            return redirect()->route(config('oxo.homepage.auth'));
        }

        $dto = $request->all();
        $dto['company_id'] = $company->id;

        $logo = Storage::disk('files')->putFile(
            $company->id,
            $request->file('logo')
        );
        $dto['logo'] = $logo;

        $user->company()->update($dto);

        return redirect()->route(config('oxo.homepage.auth'));
    }
}
