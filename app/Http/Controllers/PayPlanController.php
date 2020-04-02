<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\Routing\Redirector;
use App\Services\PayPlanService as Service;
use App\User;


class PayPlanController extends Controller
{
    private $service;

    public function __construct (Service $service) {
        $this->service = $service;
    }

    /**
     * Method to list all subscription methods to admin
     * 
     * @route admin/subscriptions
     * @method GET
     */
    public function index (Request $request, Factory $view) {
        return $view->make('admin.payplan.index',['payplans'=>$this->service->getPayplans($request)]);
    }

    /**
     * Method to list all payplan
     * 
     * @route payplan
     * @method GET
     */
    public function all (Request $request, Factory $view) {
        return $view->make('payplan.index',['payplans'=>$this->service->getPayplans($request), 'intent' => $request->user()->createSetupIntent(), 'stripe_key'=> env('STRIPE_KEY')]);
    }

    /**
     * Method to create payplan method
     * 
     * @route admin/payplan/create
     * @method GET
     */
    public function create (Request $request, Factory $view) {

        return $view->make('admin.payplan.create');
    }

    /**
     * Method to create subscription method
     * 
     * @route admin/subscriptions/create
     * @method GET
     */
    public function store (Request $request, Redirector $redirector) {
        $this->service->store ($request);
        return $redirector->to('/admin/plan')->with('message', 'Plan successfully save.');
    }

}
