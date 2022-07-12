<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Middleware\LocaleMiddleware;
use App\Models\Page;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class InvestController extends Controller
{
    public function invest_first(Request $request)
    {
        $user = Auth::user();

        $page = Page::where('slug','=','invest-first')->first();

        $this->setDefaultData();
        $this->setDefaultData();
        if($page) $this->fillMeta($page,'model');

        return $this->render('invest.invest-first');
    }

    public function invest_second(Request $request)
    {
        $user = Auth::user();

        $page = Page::where('slug','=','invest-second')->first();

        $this->setDefaultData();
        if($page) $this->fillMeta($page,'model');

        return $this->render('invest.invest-second');
    }

    public function invest_thanks(Request $request)
    {
        $user = Auth::user();

        $page = Page::where('slug','=','invest-thanks')->first();

        $this->setDefaultData();
        if($page) $this->data([
            'title'            => $page->title,
            'meta_title'       => $page->meta_title,
            'description'      => $page->description,
            'meta_description' => $page->meta_description,
        ]);

        return $this->render('invest.thanks');
    }
}
