<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class CommissionReceived extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'commission_received';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    public function user () {
        return $this->belongsTo (\App\User::class, 'user_id');
    }

    public function detail () {
        return $this->belongsTo (CommissionDetail::class, 'commission_details_id');
    }

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'disburse' => false,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'commission_details_id' => 'int',
        'commission_amount' => 'float',
        'user_id' => 'int',
        'disburse' => 'boolean'
    ];
}
