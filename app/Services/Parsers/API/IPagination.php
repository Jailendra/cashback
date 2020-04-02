<?php

namespace App\Services\Parsers\API;

interface IPagination {
    public function total ():int;
    public function currentPage ():int;
    public function totalPage ():int;
}