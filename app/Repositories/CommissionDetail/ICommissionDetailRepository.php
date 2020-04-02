<?php

namespace App\Repositories\CommissionDetail;

use App\Repositories\IRepository;

interface ICommissionDetailRepository extends IRepository {
    public function orderIdexists(string $order_id):bool;
}