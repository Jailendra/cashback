<?php

namespace App\Services\Parsers\API\Awin;

class CommissionParser {
    public function parse (object $commissions):array {
        return array_map (function ($record) {
            return $this->commission ($record);
        }, (array) $commissions);
    }

    private function commission (object $record):ICommission {
        return new Commission ($record);
    }
}