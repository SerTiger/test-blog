<?php

namespace App\Services;

use App\Models\User;

/**
 * Class PaymentService
 * @package App\Services
 */
class PaymentService
{

	public static function getExchangeRate($payment_system)
	{
		$service = config('payments.services.'.$payment_system, NULL);

		$data = ($service) ? app($service)->convertCurrency(1) : NULL;

		return $data;
	}

	public static function getCurrency($payment_system)
	{
		$service = config('payments.services.'.$payment_system, NULL);

		$data = ($service) ? app($service)->getCurrency() : NULL;

		return $data;
	}

}
