<?php

namespace App\Apis;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TradeDoubler implements IAPI {
    
    const PROPOSAL_URL = 'http://api.tradedoubler.com/1.0/products';
    const ADVERTISER_URL = 'https://api.tradedoubler.com/1.0/claims';

    /**
     * Website-ID to identify request
     * 
     * @var string
     */
    private $tokens;
    private $affiliateId;

    /**
     * Set required configuration property of commission junction
     * 
     * @param Object
     * 
     * @return void
     */
    public function __construct (object $tokens, Client $client) {
        $this->tokens = $tokens;
        $this->client = $client;
        $this->affiliateId = $tokens->AFFILIATE_ID;
    }
    
    public function proposals (array $params) {
        // http://api.tradedoubler.com/1.0/products[.xml|.json|empty][query keys]?token={token}
    }

    public function commission (string $query) {

    }

    public function advertisers (array $params) {
        try {
            return $this->client->get (self::ADVERTISER_URL . "?token={$this->tokens->TOKEN['COMMISSION']}")->getBody();
        } catch (ClientException $ex) {
            return null;
        }        
    }
}