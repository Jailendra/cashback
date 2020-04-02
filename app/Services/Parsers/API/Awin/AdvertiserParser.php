<?php

namespace App\Services\Parsers\API\Awin;
use App\Services\Parsers\API\IAdvertiser;

class AdvertiserParser {
    public function parse (object $response):array {
        return array_map (function ($advertiser) {
            return $this->advertiser ($advertiser);
        }, (array) $response);
    }

    private function advertiser (object $advertiser):IAdvertiser {
        return new Advertiser ($advertiser);
    }
}