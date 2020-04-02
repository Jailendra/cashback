<?php

namespace App\Apis;
use SoapClient;

class TradeTracker implements IAPI {

    private $affiliateSiteID;

    /**
     * Set required configuration property of commission junction
     * 
     * @param Object
     * 
     * @return void
     */
    public function __construct (string $affiliateSiteID, SoapClient $client) {
        $this->client = $client;
        $this->affiliateSiteID = $affiliateSiteID;
    }

    public function proposals (array $params) {
        return $this->client->getMaterialBannerImageItems((int) $this->affiliateSiteID, 'html', $params);
    }

    public function commission (string $query) {
        return $this->client->getPayments(json_decode ($query, true));
    }

    public function advertisers (array $params) {
        return $this->client->getCampaigns((int) $this->affiliateSiteID, $params);
    }
}