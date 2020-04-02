<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponPostRequest;
use App\Http\Requests\Admin\CouponPutRequest;
use Illuminate\View\Factory;
use Illuminate\Routing\Redirector;
use App\Http\Requests\CouponGetRequest;

use App\Services\CouponService as Service;

class CouponController extends Controller {

    protected $service;

    public function __construct (Service $service) {
        $this->service = $service;
    }

     /**
     * Display a home
     *
     * @route admin/coupons
     * @method GET
     * 
     * @return \Illuminate\Http\Response
     */
    public function home (Request $request, Factory $view) {
        return $view->make('admin.home.dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @route admin/coupons
     * @method GET
     * 
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request, Factory $view) {
        return $view->make('admin.coupon.index', ['coupons' => $this->service->getCoupons($request)]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @route admin/coupons/create
     * @method  GET
     * 
     * @return \Illuminate\Http\Response
     */
    public function create (Factory $view) {
        return $view->make('admin.coupon.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @route admin/coupons
     * @method  POST
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponPostRequest $request, Redirector $redirector) {
        $this->service->store($request);
        return $redirector->to('/admin/coupons')->with('message', 'Coupon successfully created');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Redirector $redirector) {

        $this->service->updateCoupon ($request);
        return $redirector->to('/admin/coupons/'.$request->route()->parameter('id'))->with('message', 'Coupon successfully updated');
    }

    /**
     * view the specified resource in storage.
     * 
     * @route admin/coupons
     * @method  GET
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function view (CouponGetRequest $request, Factory $view) {
        return $view->make('admin.coupon.store', ['coupon' => $this->service->getCoupon($request)]);
    }

    /**
     * delete the specified resource in storage.
     * 
     * @route admin/coupons
     * @method  DELETE
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Redirector $redirector) {
        $this->service->deleteCoupon ($request);
        return $redirector->to('/admin/coupons')->with('message', 'Coupon successfully deleted');
    }
}
