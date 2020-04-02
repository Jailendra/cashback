<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aggregator extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    public function advertisers () {
        return $this->hasMany (Advertiser::class, 'aggregator_id');
    }

    public function toggleStatus(){
        $this->active = !$this->active;
        return $this;
    }
}
