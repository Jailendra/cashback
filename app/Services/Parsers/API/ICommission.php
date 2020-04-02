<?php

namespace App\Services\Parsers\API;

interface ICommission {
    public function userId():?int;
    public function orderId():string;
    public function saleAmountUSD():float;
    public function commissionReceived():float;
    public function all():array;
}