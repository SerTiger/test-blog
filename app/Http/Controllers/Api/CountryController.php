<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Khsing\World\Exceptions\InvalidCodeException;
use Khsing\World\Models\Country;


class CountryController extends Controller
{
    public function cities($country_code): \Illuminate\Http\JsonResponse
    {
        try {
            $country = Country::getByCode($country_code);
        } catch (InvalidCodeException $e) {
            return response()->json(['data' => ['message' => 'Country not found']], 404);
        }

        $cities = $country->children();

        return response()->json(['data' => $cities]);
    }
}
