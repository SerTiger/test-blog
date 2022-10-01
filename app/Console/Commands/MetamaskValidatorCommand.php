<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;


class MetamaskValidatorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'validate:metamask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Metamask Transactions Validator Command';

    protected $transaction_service;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->transaction_service = app(TransactionService::class);
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->validateTransactions();

        return;
    }
    /**
     * Validate Metamask Transaction
     *
     * @return void
     */
    public function validateTransactions()
    {
        $transactions = Transaction::pendingTransactions()->get(); //get Pending Transactions From Database [which are older than 1min]
        //Run foreach to check transactions one by one.
        foreach ($transactions as $transaction) {
            //get transaction information from etherscan
            $response = $this->checkWithEtherScan($transaction->txHash);
            //validate response
            if ($response && array_key_exists('result', $response)) {
                $tr_data = $response['result'];
                //validate transaction destination with our account [destination must be our master account].
                if (strtolower($tr_data['to']) == strtolower($transaction->account)) { // Metamask account address here
                    // Update Transaction As Success
                    $this->transaction_service->runTransaction($transaction);
                } else {
                    // Update Transaction As Canceled
                    $this->transaction_service->cancelTransaction($transaction);
                }
            }
        }
        return;
    }
    /**
     * Check Transaction With Ether Scan
     *
     * @param  mixed $transaction_hash
     * @return mixed
     */
    public function checkWithEtherScan($transaction_hash)
    {
        $api_key = config('services.etherscan.key');
        $network = config('services.etherscan.network');
        //$network = "https://etherscan.io"; // force to use main network.

        $response = Http::get($network . "/api/?module=proxy&action=eth_getTransactionByHash&txhash="
            . $transaction_hash . '&apikey=' . $api_key);
        return $response->json();
    }
}
