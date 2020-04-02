<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Cashier\Subscription;
use App\Services\Jobs\CommissionReceivedService;
use App\Services\SubscriptionService;

class SubscriptionPurchased implements ShouldQueue
{

    const CENTS_TO_USD = 100;

    private $subscription;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CommissionReceivedService $service, SubscriptionService $subscriptionService)
    {
        $service->initialize (
            $this->subscription->user()->first(), 
            ($subscriptionService->getPlanById ($this->subscription->stripe_id))->plan->amount/self::CENTS_TO_USD, 
            $this->subscription->id,
            'subscription'
        );
    }
}
