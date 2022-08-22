<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    public function create(Request $request)
    {
        $user = auth()->user();

        $company = $user->company;

        if($company) {
            return redirect()->route(config('oxo.homepage.auth'));
        }

        return $this->render('auth.create_organization');
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
            'company/'.$company->id,
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
            'company/'.$company->id,
            $request->file('logo')
        );
        $dto['logo'] = $logo;

        $user->company()->update($dto);

        return redirect()->route(config('oxo.homepage.auth'));
    }
}
