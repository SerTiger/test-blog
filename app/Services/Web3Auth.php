<?php


namespace App\Services;

use App\Classes\Web3;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class Web3Auth
{
    public function authenticate(Request $request)
    {
        $address = (string)$request->get('address');

        $this->verifySignature($address, $request);

        $auth_wallet = Wallet::with('user')->where([
            'address'=> $address
        ])->first();

        if($auth_wallet) {
            $user = $auth_wallet->user;
            $user->update([
                'auth_wallet' => $auth_wallet->address
            ]);
        } else {
            $user = User::query()->firstOrCreate([
                'auth_address'=> $address
            ]);
            $auth_wallet = $user->wallets()->firstOrCreate([
                'address'=> $address,
            ]);
        }

        try {
            $chain = chain_info($request->get('chainId'));

            $auth_wallet->chainid = $chain['chainId'] ?? $auth_wallet->chainid;
            $auth_wallet->currency = $chain['nativeCurrency']['symbol'] ?? $auth_wallet->currency;
            $auth_wallet->network = $chain['name'] ?? $auth_wallet->network;
            $auth_wallet->save();
        } catch (\Exception $e) {
            \Log::error($e);
        }

        auth()->login($user);

        session()->forget('web3-nonce');

        return true;
    }

    public function switch($user, Request $request): bool
    {
        $address = (string)$request->get('address');

        $auth_wallet = $user->wallets()->firstOrCreate([
            'address'=> $address,
        ]);

        //try {
            $chain = chain_info(hexdec($request->get('chainId')));

            $auth_wallet->chainid = $chain['chainId'] ?? $auth_wallet->chainid;
            $auth_wallet->currency = $chain['nativeCurrency']['symbol'] ?? $auth_wallet->currency;
            $auth_wallet->network = $chain['name'] ?? $auth_wallet->network;
            $auth_wallet->save();
//        } catch (\Exception $e) {
//            \Log::error($e);
//        }

        $user->update([
            'auth_address'=> $address
        ]);

        return true;
    }

    public function signature(Request $request)
    {
        $code = \Str::random(8);

        session()->put('web3-nonce', $code);

        return $this->getSignatureMessage($code);
    }

    public function verifySignature(string $address, Request $request): bool
    {
        return Web3::verifySignature(
            $this->getSignatureMessage(session()->get('web3-nonce')),
            $request->get('signature'),
            $address,
        );
    }

    private function getSignatureMessage($code)
    {
        return __("Please sign me in.\n\nSecurity code (you can ignore this): :nonce", [
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
