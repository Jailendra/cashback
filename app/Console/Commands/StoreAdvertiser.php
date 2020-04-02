<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Commands\AdvertiserConsoleService as Service;
use App\Services\AggregatorService;

class StoreAdvertiser extends Command
{

    private $service;
    private $aggregatorService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aggregators:advertisers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save advertisers into database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct (Service $service, AggregatorService $aggregatorService)
    {
        parent::__construct();
        $this->service = $service;
        $this->aggregatorService = $aggregatorService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $aggregators = $this->aggregatorService->findActiveAggregators ()->toArray();

        array_walk($aggregators, function ($aggregator) {
            $this->service->saveAdvertisers ($aggregator);
        });
    }
}
