<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContributionController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();
        $user->load('contributions.pool.company');

        $this->data('contributions', $user->contributions);

        return $this->render('contribution.contributions');
    }
}
