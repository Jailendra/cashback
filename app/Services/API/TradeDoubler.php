<?php

namespace App\Services\API;

use App\Apis\TradeDoubler as API;
use App\Libs\XLSXReader;

class TradeDoubler {

    const SERVICE_NAME = 'tradedoubler';
    // const ASSIGN_STATUS = 'accepted';
    // const PROPOSALS_DIRECTORY = 'aggregators/proposals/tradedoubler';

    private $api;
    private $service;

    public function __construct (API $api, ProposalStorageService $service) {
        $this->api = $api;
        $this->service = $service;
        // $this->service->setDirectory (self::PROPOSALS_DIRECTORY);
    }

    public function getAdvertisers (array $params):object {
        $xlsx = new XLSXReader (storage_path('app/linkMatrix(3096454).xls'));
        dd ($xlsx->getSheet( current ($xlsx->getSheetNames()) ));

        // return (object) $this->api->advertisers ([]);
    }

    
}