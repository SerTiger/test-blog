<?php

namespace App\Services\Exchange;

use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Http;

class CoincapIo
{
    public function updateRates(){
        $data = $this->fetchRates();

        foreach($data['data'] as $datum) {
            ExchangeRate::query()->updateOrCreate([
                'currency' => $datum['symbol'],
            ],[
                'symbol' => $datum['currencySymbol'],
                'type' => $datum['type'],
                'rate' => $datum['rateUsd'],
                'slug' => $datum['id'],
            ]);
        }
    }

    public function getRate($currency){
        $rate = ExchangeRate::query()->where([
            'currency' => $currency
        ])->first();

        return $rate ? $rate->rate : 0;
    }

    private function fetchRates() {
        $response = Http::get('https://api.coincap.io/v2/rates');
        return $response->json();
    }
}
