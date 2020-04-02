<?php

namespace App\Repositories\CommissionDetail;

use App\Repositories\Repository;

class CommissionDetailRepository extends Repository implements ICommissionDetailRepository {
    /**
     * Method to check if order-id exists or not
     * 
     * @param string order-id
     * 
     * @return boolean
     */
    public function orderIdexists(string $order_id):bool {
        return $this->model->where('order_id', $order_id)->exists();
    }
}