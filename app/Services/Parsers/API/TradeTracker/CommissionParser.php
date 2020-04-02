<?php

namespace App\Services\Parsers\API\TradeTracker;

use App\Services\Parsers\API\ICommission;

class CommissionParser {

    public function parse (object $commissions):array {
        // return array_map (function ($record) {
        //     return $this->commission ($record);
        // }, $commissions->data->publisherCommissions->records);
    }

    private function commission (object $record):ICommission {
        return new Commission ($record);
    }
}