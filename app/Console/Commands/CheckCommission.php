<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Commands\CommissionService as Service;

class CheckCommission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aggregators:commission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for New commission';

    /**
     * API-Service 
     * 
     * @var App\Services\APIService
     */

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Service $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->service->saveCommission();
    }
}
