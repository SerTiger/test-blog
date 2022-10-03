<?php

namespace App\Services;

use App\Models\ExchangeRate;
use App\Services\Exchange\CoincapIo;
use Illuminate\Support\Facades\Storage;

/**
 * Class PaymentService
 * @package App\Services
 */
class PaymentService
{

	public function convertToUSD($currency, $amount= 1): float
    {
	    $rate = app(CoincapIo::class)->getRate($currency);

		return round($rate*$amount,2);
	}

    public function convertToETH($currency, $amount= 1): float
    {
        $rate = app(CoincapIo::class)->getRate($currency);
        $eth_rate = app(CoincapIo::class)->getRate('ETH');

        return round($rate*$amount/$eth_rate,16);
    }

    public function getInfo($currency): array
    {
        $rate = ExchangeRate::query()->where([
            'currency' => $currency
        ])->first();

        $data = Storage::disk('local')->get('chainlist/chains.json');
        $data = collect(json_decode($data,true));

        $net = $data->where('nativeCurrency.symbol',$currency)->first();

        if(!empty($net['nativeCurrency'])) {
            $net_currency = collect($net['nativeCurrency'])->where('symbol', $currency)->first()->toArray();
        } else {
            $net_currency = [];
        }
        $net['currency'] = array_merge($net_currency,$rate->toArray());

        $net['currency']['symbol'] = $net['currency']['symbol'] ?? ($net_currency ? $net_currency['symbol'] : $currency);

        return $net;
    }

    public function getSymbol($currency): string
    {
        $info = ExchangeRate::query()->where([
            'currency' => $currency
        ])->first();

        return  $info ? ($info->symbol ?? $info->currency): $currency;
    }
}
