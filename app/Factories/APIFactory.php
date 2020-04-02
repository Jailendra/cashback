<?php

namespace App\Factories;

use App\Services\API\CommissionJunction;
use App\Services\Parsers\API\CommissionJunction\PaginateParser as CJPaginateParser;
use App\Services\Parsers\API\CommissionJunction\AdvertiserParser as CJAdvertiserParser;
use App\Services\Parsers\API\CommissionJunction\ProposalParser as CJProposalParser;
use App\Services\Parsers\API\CommissionJunction\DetailParser as CJProposalDetailParser;
use App\Services\Parsers\API\CommissionJunction\CommissionParser as CJCommissionParser;

use App\Services\API\TradeTracker;
use App\Services\Parsers\API\TradeTracker\PaginateParser as TradeTrackerPaginateParser;
use App\Services\Parsers\API\TradeTracker\AdvertiserParser as TradeTrackerAdvertiserParser;
use App\Services\Parsers\API\TradeTracker\ProposalParser as TradeTrackerProposalParser;
use App\Services\Parsers\API\TradeTracker\DetailParser as TradeTrackerProposalDetailParser;
use App\Services\Parsers\API\TradeTracker\CommissionParser as TradeTrackerCommissionParser;

use App\Services\API\Awin;
use App\Services\Parsers\API\Awin\AdvertiserParser as AwinAdvertiserParser;
use App\Services\Parsers\API\Awin\ProposalParser as AwinProposalParser;
use App\Services\Parsers\API\Awin\CommissionParser as AwinCommissionParser;

class APIFactory {

    private $commissionJunction;
    private $tradeTracker;
    private $awin;
    
    public function __construct (CommissionJunction $commissionJunction, TradeTracker $tradeTracker, Awin $awin) { 
        $this->commissionJunction = $commissionJunction;
        $this->tradeTracker = $tradeTracker;
        $this->awin = $awin;
    }
    

    /**
     * Select library to fetch records
    */
    public function createAggregatorLibrary (string $aggregatorName) {
        switch (strtoupper ($aggregatorName)) {
            case strtoupper (CommissionJunction::SERVICE_NAME):
                return $this->commissionJunction;
            case strtoupper (TradeTracker::SERVICE_NAME):
                return $this->tradeTracker;
            case strtoupper (Awin::SERVICE_NAME):
                return $this->awin;
        }
    }

    public function paginateParser (string $aggregatorName) {
        switch (strtoupper ($aggregatorName)) {
            case strtoupper (CommissionJunction::SERVICE_NAME):
                return new CJPaginateParser;
            case strtoupper (TradeTracker::SERVICE_NAME):
                return new TradeTrackerPaginateParser;
            case strtoupper (Awin::SERVICE_NAME):
                return new TradeTrackerPaginateParser;
        }
    }

    public function advertiserParser (string $aggregatorName) {
        switch (strtoupper ($aggregatorName)) {
            case strtoupper (CommissionJunction::SERVICE_NAME):
                return new CJAdvertiserParser;
            case strtoupper (TradeTracker::SERVICE_NAME):
                return new TradeTrackerAdvertiserParser;
            case strtoupper (Awin::SERVICE_NAME):
                return new AwinAdvertiserParser;
        }
    }

    public function proposalsParser (string $aggregatorName) {
        switch (strtoupper ($aggregatorName)) {
            case strtoupper (CommissionJunction::SERVICE_NAME):
                return new CJProposalParser;
            case strtoupper (TradeTracker::SERVICE_NAME):
                return new TradeTrackerProposalParser;
            case strtoupper (Awin::SERVICE_NAME):
                return new AwinProposalParser;
        }
    }

    public function proposalsDetailParser (string $aggregatorName) {
        switch (strtoupper ($aggregatorName)) {
            case strtoupper (CommissionJunction::SERVICE_NAME):
                return new CJProposalDetailParser;
            case strtoupper (TradeTracker::SERVICE_NAME):
                return new TradeTrackerProposalDetailParser;
        }
    }

    public function commissionParser (string $aggregatorService) {
        switch (strtoupper ($aggregatorService)) {
            case strtoupper (CommissionJunction::SERVICE_NAME):
                return new CJCommissionParser;
            case strtoupper (TradeTracker::SERVICE_NAME):
                return new TradeTrackerCommissionParser;
            case strtoupper (Awin::SERVICE_NAME):
                return new AwinCommissionParser;
        }
    }
}