<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\Routing\Redirector;
use App\Services\SubscriptionService as Service;
use App\Http\Requests\SubscriptionPostRequest;


class SubscriptionController extends Controller
{
    private $service;

    public function __construct (Service $service) {
        $this->service = $service;
    }

    /**
     * Method to purchase userSubscription
     */
    public function purchase (SubscriptionPostRequest $request, Redirector $redirector) {

        $this->service->purchase ($request);
        return $redirector->to('/subscriptions/active')->with('message', 'Subscription successfully purchased.');
    }

    /**
     * Method to get current subscription of the user
     * 
     * @route
     * @method GET
     */
    public function userSubscription (Request $request, Factory $view) {
        return $view->make('subscription.active', ['subscription' => $this->service->userActiveSubscription($request)]);
    }
}
