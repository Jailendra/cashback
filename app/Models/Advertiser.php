<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertiser extends Model {
    use SoftDeletes;
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
        'status' => 'boolean',
        'categories' => 'json',
        'link_types' => 'json',
        'commission' => 'float'
    ];
     
    /* The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['logo'];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['image'];


    public function getLogoAttribute () {
        return ($this->image && filter_var($this->image, FILTER_VALIDATE_URL)) ?  $this->image : url ("/resources/{$this->id}/advertiser");
    }

    public function aggregator () {
        return $this->belongsTo (Aggregator::class, 'aggregator_id');
    }

    public function custom () {
        return $this->hasOne(AdvertisorCustom::class, 'advertiser_id', 'advertiser_id');
    }
}
