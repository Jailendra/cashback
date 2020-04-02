<?php

namespace App\Apis;
use GuzzleHttp\Client;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class Awin implements IAPI {
    
    const URL = 'https://api.awin.com';

    /**
     * Account-ID or publisher-ID
     * 
     * @var string
     */
    private $accountId;


    /**
     * Set required configuration property of commission junction
     * 
     * @param Object
     * 
     * @return void
     */
    public function __construct (string $accountId, Client $client) {
        $this->accountId = $accountId;
        $this->client = $client;
    }



    /**
     * Method to get proposals links aor affilates links
     * @param array $params = ['advertiserId' => 1001]
     * @return XML
     */
    public function proposals (array $params) {
        return $this->client->get (self::URL."/publishers/{$this->accountId}/programmedetails", ['query' => $query])->getBody()->getContents();
    }


    /**
     * Method to fetch commission received
     * 
     * @return object
     */
    public function commission (string $query) {
        return $this->client->get (self::URL."/publishers/{$this->accountId}/transactions/", ['query' => json_decode ($query, true)])->getBody()->getContents();
    }

    public function advertisers (array $params) {
        return $this->client->get (self::URL.'/accounts', ['query' => $params])->getBody()->getContents();
    }
}