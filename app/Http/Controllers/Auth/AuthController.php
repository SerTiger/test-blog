<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Web3Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;

class  AuthController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request, Web3Auth $auth){

        $is_authenticate = $auth->authenticate($request);

        return $is_authenticate
            ? redirect()->route(config('oxo.homepage.auth'))
            : redirect()->route(config('oxo.homepage.guest'))
            ;
    }

    public function signature(Request $request, Web3Auth $auth) {
        return $auth->signature($request);
    }

    public function switch(Request $request, Web3Auth $auth) {
        $user = auth()->user();

        return $auth->switch($user,$request);
    }

    public function logout(){

        Auth::logout();

        return redirect()->route(config('oxo.homepage.guest'));
    }
}
