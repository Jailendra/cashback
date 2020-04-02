<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Commands\ProposalService as Service;

class ClearProposals extends Command
{

    private $service;

    public function __construct (Service $service) {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aggregators:clear-proposals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all cache proposals from storage';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->service->clearProposals();
    }
}
