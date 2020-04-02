<?php

namespace App\Apis;

interface IAPI {
    public function proposals (array $params);
    public function commission (string $query);
    public function advertisers (array $params);
}