<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionDistribution extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'commission' => 'float',
        'level' => 'int'
    ];
}
