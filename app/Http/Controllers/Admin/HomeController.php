<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        $flag = false;

        foreach ($user->roles as $role){
            if($role->title != 'User'){
                $flag = true;
            }
        }
        if(!$flag){
            abort(403);
        }

        return view('admin.view.home.index');
    }

    public function users()
    {
        return view('admin.index');
    }
}
