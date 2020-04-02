<?php

namespace App\Services\Parsers\API\CommissionJunction;
use App\Services\Parsers\API\IPagination;

class Pagination implements IPagination {

    private $attributes;

    public function __construct (array $attributes)  {
        $this->attributes = $attributes;
    }

    public function total ():int {
        return (int) $this->attributes['total-matched'];
    }

    public function currentPage ():int {
        return (int) $this->attributes['page-number'];
    }

    public function totalPage ():int {
        return ceil ($this->total()/((int) $this->attributes['records-returned']));
    }
}