<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model {
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['image'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['trademark'];

    public function getTrademarkAttribute () {
        return url("/resources/{$this->id}/trademark");
    }
}
