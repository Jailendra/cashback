<?php

namespace App\Services\Parsers\API\CommissionJunction;
use App\Services\Parsers\API\IAdvertiser;

class Advertiser implements IAdvertiser {

    private $advertiser;

    public function __construct (array $advertiser)  {
        $this->advertiser = $advertiser;
    }

    public function id ():int {
        return (int) $this->advertiser['advertiser-id'];
    }

    public function status ():bool {
        return $this->advertiser['account-status'] === 'Active' ?  true : false;
    }

    public function name ():string {
        return $this->advertiser['advertiser-name'];
    }

    public function categories ():array {
        return array_values ((array) $this->advertiser['primary-category']);
    }

    public function image ():?string {
        return null;
    }

    public function commission():?float {
        return null;
    }

    public function startDate():?string {
        return null;
    }

    public function endDate():?string {
        return null;
    }
}