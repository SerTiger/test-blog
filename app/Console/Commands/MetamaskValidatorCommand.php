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
        //get Pending Transactions From Database [which are older than 1min]
        Transaction::withFee()
        ->pending(false)
        ->whereNotNull('txHash')
        ->chunk(4, function($transactions) {
            //Run foreach to check transactions one by one.
            foreach ($transactions as $transaction) {
                $is_revert = !empty($transaction->revert_txHash);
                $this->info($transaction->id);
                //get transaction information from etherscan
                $response = $this->checkWithEtherScan($is_revert ? $transaction->revert_txHash : $transaction->txHash);

                //validate response
                if ($response && array_key_exists('result', $response)) {
                    $tr_data = $response['result'];
                    if (empty($tr_data['blockHash'])) {
                        $this->info('blockHash');
                        continue;
                    }

                    if (hexdec($tr_data['value']) / 1000000000000000000 != $transaction->amount) {
                        $diff = hexdec($tr_data['value']) / 1000000000000000000 / $transaction->amount;
                        $this->info($diff);
                        if (!(0.97 < $diff || $diff < 1.03)) // allow 3% difference
                            continue;
                    }

                    if ($is_revert) {

                        //validate transaction destination with our account [destination must be contributor account].
                        if (strtolower($tr_data['to']) == strtolower($transaction->contributor_account)) { // Metamask account address here
                            // Update Transaction As Success
                            $this->info('ROLLBACK');
                            $this->transaction_service->rollbackTransaction($transaction);
                        } else {
                            // Update Transaction As Canceled
                            $this->info('CANCEL');
                            $this->transaction_service->cancelTransaction($transaction);
                        }

                    } else {
                        //validate transaction destination with our account [destination must be our master account].
                        if (strtolower($tr_data['to']) == strtolower($transaction->destination_account)) { // Metamask account address here
                            // Update Transaction As Success
                            $this->info('RUN');
                            $this->transaction_service->runTransaction($transaction);
                        } else {
                            // Update Transaction As Canceled
                            $this->info('CANCEL');
                            $this->transaction_service->cancelTransaction($transaction);
                        }

                    }
                } else {
                    $this->info('no result');
                }
            }
            sleep(1);
        });

        Transaction::onlyDraft()->draft()->chunk(50, function($transactions) {
            foreach ($transactions as $transaction) {
                $this->transaction_service->cancelTransaction($transaction);
            }
        });

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
        //$network = "https://api-ropsten.etherscan.io/"; // force to use network

        $response = Http::get($network . "/api/?module=proxy&action=eth_getTransactionByHash&txhash="
            . $transaction_hash . '&apikey=' . $api_key);
        return $response->json();
    }
}
