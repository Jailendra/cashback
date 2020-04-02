<?php

namespace App\Services\Parsers\API\TradeTracker;
use App\Services\Parsers\API\IAdvertiser;

class Advertiser implements IAdvertiser {

    private $advertiser;

    public function __construct (object $advertiser)  {
        $this->advertiser = $advertiser;
    }

    public function id ():int {
        return (int) $this->advertiser->ID;
    }

    public function status ():bool {
        return true;
    }

    public function name ():string {
        return $this->advertiser->name;
    }

    public function categories ():array {
        return array_merge ([$this->advertiser->info->category->name], array_map (function ($subCategory) {
            return $subCategory->name;
        }, $this->advertiser->info->subCategories));
    }

    public function image ():?string {
        return $this->advertiser->info->imageURL;
    }

    public function commission():?float {
        return $this->advertiser->info->commission->saleCommissionVariable;
    }

    public function startDate():?string {
        return $this->advertiser->info->startDate;
    }

    public function endDate():?string {
        return $this->advertiser->info->stopDate;
    }
}