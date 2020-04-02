<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\CommissionDetail as CommissionDetailObserver;
use App\Models\CommissionDetail as CommissionDetailModel;

use App\Observers\Subscription as SubscriptionObserver;
use Laravel\Cashier\Subscription as SubscriptionModel;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        CommissionDetailModel::observe(CommissionDetailObserver::class);

        SubscriptionModel::observe(SubscriptionObserver::class);
    }
}
