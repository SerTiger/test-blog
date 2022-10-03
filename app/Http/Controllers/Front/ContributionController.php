<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pool;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContributionController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();

        $filter= $request->only('from','to','status','currency');
        $user->load(['contributions'=>function($q) use ($filter){
            if(!empty($filter['from'])) { $q->where('created_at','>',Carbon::parse($filter['from'])->startOfDay()); }
            if(!empty($filter['to'])) { $q->where('created_at','<',Carbon::parse($filter['to'])->endOfDay()); }
            if(!empty($filter['status']) && $filter['status']!='all') { $q->where('status','=',app(Transaction::class)->getStatusIdByKey($filter['status'])); }
            if(!empty($filter['currency'])  && $filter['currency']!='all') { $q->where('currency','LIKE', '%::'.$filter['currency']); }
            return $q;
        },'contributions.pool.company']);

        $this->data('filter', $filter);
        $this->data('contributions', $user->contributions->reverse());

        $this->data('transaction_statuses',app(Transaction::class)->getStatuses());
        $this->data('transaction_currencies', $user->contributions()->pluck('currency')->map(function($curr) {
            return explode('::',$curr)[1];
        })->unique());

        return $this->render('contribution.contributions');
    }
}
