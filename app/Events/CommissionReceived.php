<?php

namespace App\Events;

use App\Models\CommissionDetail;

class CommissionReceived
{
    /**
     * User-id who purchased
     * 
     * @var CommissionDetail Model
     */
    public $commissionDetail;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CommissionDetail $commissionDetail)
    {
        $this->commissionDetail = $commissionDetail;
    }
}
