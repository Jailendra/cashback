<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\IRepository;
use App\Repositories\Repository;

use App\Models\Aggregator;
use App\Repositories\Aggregator\IAggregatorRepository;
use App\Repositories\Aggregator\AggregatorRepository;

use App\Models\Coupon;
use App\Repositories\Coupon\ICouponRepository;
use App\Repositories\Coupon\CouponRepository;

use App\Models\AffiliateCommission;
use App\Repositories\Affiliate\IAffiliateRepository;
use App\Repositories\Affiliate\AffiliateRepository;

use App\Models\CommissionDetail;
use App\Repositories\CommissionDetail\ICommissionDetailRepository;
use App\Repositories\CommissionDetail\CommissionDetailRepository;

use App\Models\CommissionDistribution;
use App\Repositories\CommissionDistribution\ICommissionDistributionRepository;
use App\Repositories\CommissionDistribution\CommissionDistributionRepository;

use App\User;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;

use App\Models\CommissionReceived;
use App\Repositories\CommissionReceived\ICommissionReceivedRepository;
use App\Repositories\CommissionReceived\CommissionReceivedRepository;

use App\Models\Advertiser;
use App\Repositories\Advertiser\IAdvertiserRepository;
use App\Repositories\Advertiser\AdvertiserRepository;

use App\Models\PayPlan;
use App\Repositories\PayPlan\IPayPlanRepository;
use App\Repositories\PayPlan\PayPlanRepository;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind (IRepository::class, Repository::class);

        $this->app->bind (IAggregatorRepository::class, function ($app) {
            return new AggregatorRepository (new Aggregator);
        });

        $this->app->bind (ICouponRepository::class, function ($app) {
            return new CouponRepository (new Coupon);
        });

        $this->app->bind (IAffiliateRepository::class, function ($app) {
            return new AffiliateRepository (new AffiliateCommission);
        });
        
        $this->app->bind (ICommissionDetailRepository::class, function ($app) {
            return new CommissionDetailRepository (new CommissionDetail);
        });

        $this->app->bind (ICommissionDistributionRepository::class, function ($app) {
            return new CommissionDistributionRepository (new CommissionDistribution);
        });

        $this->app->bind (IUserRepository::class, function ($app) {
            return new UserRepository (new User);
        });

        $this->app->bind (ICommissionReceivedRepository::class, function ($app) {
            return new CommissionReceivedRepository (new CommissionReceived);
        });

        $this->app->bind (IAdvertiserRepository::class, function ($app) {
            return new AdvertiserRepository (new Advertiser);
        });

        $this->app->bind (IPayPlanRepository::class, function ($app) {
            return new PayPlanRepository (new PayPlan);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
