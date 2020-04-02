<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Factory;
use App\Services\CouponService as Service;

class CouponController extends Controller
{   

    protected $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Service $service) {
        $this->service = $service;        
    }

    public function index (Request $request, Factory $view) {
      
        return $view->make('coupon.index');
       
    }

    public function getSpecialCoupons(Request $request) {
        
        return $this->service->getActiveCoupons($request);

    }
}
