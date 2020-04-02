<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Factory;
use App\Services\CouponService as Service;
use App\User;

class HomeController extends Controller
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
        $user = $request->user();
        return $view->make('home.index', ['coupons' => $this->service->getActiveCoupons($request)]);
    }
}
