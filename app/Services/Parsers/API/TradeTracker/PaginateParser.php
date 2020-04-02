<?php

namespace App\Services\Parsers\API\TradeTracker;
use App\Services\Parsers\API\IPagination;

class PaginateParser {

    public function parse (object $response):IPagination {
        return new Pagination ((array) $response);
    }
}