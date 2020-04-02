<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\PayPlan\IPayPlanRepository as Repository;

class PayPlanService {

    private $repository;

    public function __construct (Repository $repository) {
        $this->repository = $repository;
    }

    public function getPayplans (Request $request) {

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        return \Stripe\Plan::all(["limit" => 10]);
    }

    public function store (Request $request) {
        $payplan_id = md5(date('Ymdhis'));
        if($request->interval=="15 days"){
            $interval="day";
            $interval_count = 15;
        }else{
            $interval=$request->interval;
            $interval_count = 1;
        }
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        return \Stripe\Plan::create([
            'currency' => $request->currency,
            "product" => "prod_FfbyWB6RI5rSYr",
            'interval' => $interval,
            'interval_count' => $interval_count,
            'id' => $payplan_id,
            'nickname' => $request->nickname,
            'amount' => (int) ( (string) ( $request->amount * 100 )), //change doller to cents
            'metadata'=>[
                "description"=>$request->description
            ]
        ]);
    }
}