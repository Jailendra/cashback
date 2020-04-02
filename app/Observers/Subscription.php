<?php

namespace App\Observers;

use Laravel\Cashier\Subscription as Model;
use App\Jobs\SubscriptionPurchased;

class Subscription
{
    /**
     * Handle the user subscription "created" event.
     *
     * @param  \Laravel\Cashier\Subscription  $userSubscription
     * @return void
     */
    public function created(Model $model)
    {
        dispatch (new SubscriptionPurchased ($model));
    }
}
