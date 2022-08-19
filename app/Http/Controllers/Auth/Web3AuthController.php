<?php


namespace App\Http\Controllers\Auth;

use App\Classes\Web3;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class Web3AuthController extends Controller
{

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
