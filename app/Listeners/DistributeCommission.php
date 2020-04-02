<?php

namespace App\Listeners;

use App\Services\Jobs\CommissionReceivedService as Service;
use App\Events\CommissionReceived;

class DistributeCommission
{
    private $service;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommissionReceived $event)
    {
        $this->service->initialize (
            $event->commissionDetail->user()->first(), 
            $event->commissionDetail->total_commission_usd, 
            $event->commissionDetail->id,
            'commission'
        );
    }
}
