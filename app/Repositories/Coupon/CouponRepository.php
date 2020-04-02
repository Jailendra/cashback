<?php

namespace App\Repositories\Coupon;

use App\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;

class CouponRepository extends Repository implements ICouponRepository {
    
    public function paginateActiveCoupons (int $limit):LengthAwarePaginator {
        return $this->model->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->paginate($limit);
    }
}