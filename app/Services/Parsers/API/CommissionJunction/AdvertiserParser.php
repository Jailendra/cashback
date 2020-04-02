<?php

namespace App\Services\Parsers\API\CommissionJunction;
use App\Services\Parsers\API\IAdvertiser;

class AdvertiserParser {

    public function parse (object $response):array {
        return array_map (function ($advertiser) {
            return $this->advertiser ((array) $advertiser);
        }, end ($response->{key($response)}));
    }

    private function advertiser (array $advertiser):IAdvertiser {
        return new Advertiser ($advertiser);
    }
}