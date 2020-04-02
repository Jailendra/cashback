<?php

namespace App\Services\Parsers\API\Awin;
use App\Services\Parsers\API\IAdvertiser;

class Advertiser implements IAdvertiser {

    private $advertiser;

    public function __construct (object $advertiser)  {
        $this->advertiser = $advertiser;
    }

    public function id ():int {
        return (int) $this->advertiser->accountId;
    }

    public function status ():bool {
        return true;
    }

    public function name ():string {
        return $this->advertiser->accountName;
    }

    public function categories ():array {
        return [];
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