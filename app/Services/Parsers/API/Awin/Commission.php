<?php

namespace App\Services\Parsers\API\Awin;

use App\Services\Parsers\API\ICommission;

class Commission implements ICommission {
    private $record;

    public function __construct (object $record) {
        $this->record = $record;
    }

    public function userId():?int {
        $params = array_column ($this->record->customParameters, 'value', 'key');
        return array_key_exists ('uid', $params) ? $params['uid'] : null;
    }

    public function orderId():string {
        return $this->record->id;
    }

    public function saleAmountUSD():float {
        return $this->record->saleAmount->amount;
    }

    public function commissionReceived():float {
        return $this->record->commissionAmount->amount;
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