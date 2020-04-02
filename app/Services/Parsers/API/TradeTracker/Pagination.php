<?php

namespace App\Services\Parsers\API\TradeTracker;
use App\Services\Parsers\API\IPagination;

class Pagination implements IPagination {

    private $attributes;

    public function __construct (array $attributes)  {
        $this->attributes = $attributes;
    }

    public function total ():int {
        return count ($this->attributes);
    }

    public function currentPage ():int {
        return count ($this->attributes) ? 1 : 0;
    }

    public function totalPage ():int {
        return $this->currentPage();
    }
}