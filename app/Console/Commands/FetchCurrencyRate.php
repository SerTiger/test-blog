<?php

namespace App\Console\Commands;

use App\Services\Exchange\CoincapIo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Exception;

/**
 * Class FetchCurrencyRate
 * @package App\Console\Commands
 */
class FetchCurrencyRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:fetch-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch currencies rates';

    private $exchanger;

    public function __construct(CoincapIo $exchanger)
    {
        parent::__construct();

        $this->exchanger = $exchanger;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */

    public function handle()
    {
        try{
            $this->exchanger->updateRates();
        } catch(\Exception $e) {
            \Log::error($e);
        }
    }
}

