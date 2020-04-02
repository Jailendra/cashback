<?php

namespace App\Repositories\Coupon;

use App\Repositories\IRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICouponRepository extends IRepository {
    public function paginateActiveCoupons (int $limit):LengthAwarePaginator;
}