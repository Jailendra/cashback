<?php

namespace App\Apis;
use GuzzleHttp\Client;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class CommissionJunction implements IAPI {
    
    const PROPOSAL_URL = 'https://link-search.api.cj.com/v2/link-search';
    const COMMISSION_DETAIL_URL = "https://commissions.api.cj.com/query";
    const ADVERTISER_LOOKUP_URL = "https://advertiser-lookup.api.cj.com/v2/advertiser-lookup";

    /**
     * Website-ID to identify request
     * 
     * @var string
     */
    private $website_id;

    /**
     * Website-ID to identify request
     * 
     * @var string
     */
    private $publisher_id;


    /**
     * Set required configuration property of commission junction
     * 
     * @param Object
     * 
     * @return void
     */
    public function __construct (object $config, Client $client) {
        $this->website_id = $config->WEBSITE_ID;
        $this->client = $client;
        $this->publisher_id = $config->PUBLISHER_ID;
    }



    /**
     * Method to get proposals links aor affilates links
     * 
     * @return XML
     */
    public function proposals (array $params) {
        try {
            $query = array_merge (['website-id' => $this->website_id], $params);
            return $this->client->get (self::PROPOSAL_URL, ['query' => $query])->getBody();
        } catch (ClientException $ex) {
            return null;
        } catch (ServerException $ex) {
            return null;
        }
    }


    /**
     * Method to send publisher-ID
     * 
     * @return int
     */
    public function getPublisherId ():int {
        return $this->publisher_id;
    }


    /**
     * Method to fetch commission received
     * 
     * @return object
     */
    public function commission (string $query) {
        try {
            return $this->client->post (self::COMMISSION_DETAIL_URL, [
                'headers' => ['content-type' => 'application/json'],
                'json' => ['query' => $query]
            ])->getBody();
        } catch (ClientException $ex) {
            abort($ex->getCode(), $ex->getMessage());
        }
    }

    public function advertisers (array $params) {
        try {
            $query = array_merge (['requestor-cid' => $this->publisher_id, 'advertiser-ids' => 'joined'], $params);
            return $this->client->get (self::ADVERTISER_LOOKUP_URL, ['query' => $query])->getBody();
        } catch (ClientException $ex) {
            abort($ex->getCode(), $ex->getMessage());
        }
    }
}