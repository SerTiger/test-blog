<?php


namespace App\Http\Controllers;

use App\Classes\Web3;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;

class Web3AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        Web3::verifySignature(
            $this->getSignatureMessage(session()->get('metamask-nonce')),
            $request->get('signature'),
            $request->get('address'),
        );

        $user = User::query()->firstOrCreate([
            'eth_address'=> $request->get('address')
        ]);

        auth()->login($user);

        session()->forget('metamask-nonce');

        return true;
    }

    public function signature(Request $request)
    {
        $code = \Str::random(8);

        session()->put('metamask-nonce', $code);

        return $this->getSignatureMessage($code);
    }

    private function getSignatureMessage($code)
    {
        return __("I have read and accept the terms and conditions.\nPlease sign me in.\n\nSecurity code (you can ignore this): :nonce", [
            'nonce' => $code
        ]);
    }

    public function createTransaction(Request $request)
    {
        return  Transaction::create([
            "txHash" => $request->txHash,
            "amount" => $request->amount,
        ]);
    }

    public function listTransaction(Request $request)
    {
        return  Transaction::all();
    }
}
