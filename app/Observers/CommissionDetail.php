<?php

namespace App\Observers;

use App\Models\CommissionDetail as Model;
use App\events\CommissionReceived;

class CommissionDetail
{
    /**
     * Handle the models commission detail "created" event.
     *
     * @param  \App\CommissionDetail  $modelsCommissionDetail
     * @return void
     */
    public function created(Model $model) {
        event(new CommissionReceived($model));
    }
}
