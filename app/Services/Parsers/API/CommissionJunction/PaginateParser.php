<?php

namespace App\Services\Parsers\API\CommissionJunction;
use App\Services\Parsers\API\IPagination;

class PaginateParser {

    public function parse (object $response):IPagination {
        return new Pagination ((array) current ($response->{key($response)}));
    }
}