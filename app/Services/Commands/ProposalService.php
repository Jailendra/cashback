<?php

namespace App\Services\Commands;
use App\Services\StorageService;

class ProposalService {

    private $storageService;

    public function __construct (StorageService $storageService) {
        $this->storageService = $storageService;
    }

    /**
     * Method to clear all proposals cached into storage
     * 
     * @command  aggregators:clear-proposals
     */
    public function clearProposals () {
        $this->storageService->removeDirectory ('/aggregators/proposals');
    }

}