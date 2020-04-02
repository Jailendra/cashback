<?php

namespace App\Services\Parsers\API\CommissionJunction;

use App\Services\Parsers\API\ICommission;

class Commission implements ICommission {

    private $record;

    public function __construct (object $record) {
        $this->record = $record;
    }

    public function userId():?int {
        return $this->record->shopperId;
    }

    public function orderId():string {
        return $this->record->orderId;
    }

    public function saleAmountUSD():float {
        return $this->record->saleAmountUsd;
    }

    public function commissionReceived():float {
        return array_sum (array_map (function ($item) {
            return (float) $item->totalCommissionUsd;
        }, $this->record->items));
    }

    public function all():array {
        return [
            // "actionStatus"  => $this->record->actionStatus,
            "aid" => $this->record->aid,
            "clickDate" => $this->record->clickDate,
            // "clickReferringURL" => $this->record->clickReferringURL,
            "coupon" => $this->record->coupon,
            "orderId" => $this->record->orderId,
            "saleAmountPubCurrency" => $this->record->saleAmountPubCurrency,
            "saleAmountUsd" => $this->record->saleAmountUsd,
            "user_id" => $this->record->shopperId,
            // "sid" => $this->record->sid,
            "items" => $this->record->items
        ];
    }
}