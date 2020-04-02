<?php

namespace App\Apis\Stripe;

use Stripe\Stripe as API; 
use Stripe\Subscription;

class Stripe {

    public function __construct (object $obj) {
        API::setApiKey ($obj->SECRET);
    }

    public function getPlanById (string $stripe_id) {
        return Subscription::retrieve($stripe_id);
    }
}