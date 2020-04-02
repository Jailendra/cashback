<?php

namespace App\Services\Parsers\API;

interface IProposalDetail {
    public function commission ():?string;
    public function advertiserId ():int;
    public function advertiserName ():?string;
    public function category ():?string;
    public function language ():?string;
    public function description ():?string;
    public function name ():?string;
    public function type ():?string;
    public function clickUrl ():?string;
    public function expiryDate ():?string;
    public function imageUrl ():string;
    public function setField (string $field, string $value);
}