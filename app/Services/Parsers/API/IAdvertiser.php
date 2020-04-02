<?php

namespace App\Services\Parsers\API;

interface IAdvertiser {
    public function id ():int;
    public function status ():bool;
    public function name ():string;
    public function categories ():array;
    public function image ():?string;
    public function commission():?float;
    public function startDate():?string;
    public function endDate():?string;
}