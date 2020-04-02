<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\Parsers\API\IPagination;
use App\Factories\APIFactory as Factory;

class APIService {

    private $factory;

    public function __construct (Factory $factory) {
        $this->factory = $factory;
    }

    /**
     * Method to select respective library of the aggregator
    */
    private function aggregatorSelection (string $aggregatorName) {
        return $this->factory->createAggregatorLibrary ($aggregatorName);
    }

    public function getAdvertisers (string $aggregatorName, array $params) {
        return $this->aggregatorSelection ($aggregatorName)->getAdvertisers ($params);
    }

    public function parsePagination (string $aggregatorName, object $apiResponse):IPagination {
        return $this->factory->paginateParser ($aggregatorName)->parse ($apiResponse);
    }

    public function parseAdvertisers (string $aggregatorName, object $apiResponse):array {
        return $this->factory->advertiserParser ($aggregatorName)->parse ($apiResponse);
    }

    public function listProposal (string $aggregatorName, array $advertisors, array $params) {
        return $this->aggregatorSelection ($aggregatorName)->getProposals($advertisors, $params);
    }

    public function parseProposals (string $aggregatorName, object $apiResponse) {
        return $this->factory->proposalsParser ($aggregatorName)->parse ($apiResponse);
    }

    public function proposalDetail (string $aggregatorName, int $advertiserId) {
        return $this->aggregatorSelection ($aggregatorName)->proposalDetail ($advertiserId);
    }

    public function parseProposalDetail (string $aggregatorName, object $apiResponse) {
        return $this->factory->proposalsDetailParser ($aggregatorName)->parse ($apiResponse);
    }

    public function getCommission (string $aggregatorName) {
        return $this->aggregatorSelection ($aggregatorName)->getCommission();
    }

    public function parseCommission (string $aggregatorName, object $apiResponse) {
        return $this->factory->commissionParser ($aggregatorName)->parse ($apiResponse);
    }
}