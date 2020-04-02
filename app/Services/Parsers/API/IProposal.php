<?php

namespace App\Services\Parsers\API;

interface IProposal {
    public function advertiserId ():?int;
    public function advertiserName ():?string;
    public function category ():?string;
    public function description ():?string;
    public function name ():?string;
    public function total ():?int;
    public function saleCommission ():?string;
    public function imageUrl ():?string;
    public function toArray():array;
    public function setField (string $name, string $value);
    public function logo():?string;
}