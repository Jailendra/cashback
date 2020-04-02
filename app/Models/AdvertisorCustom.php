<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertisorCustom extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $fillable = ['advertiser_id', 'image', 'name'];
    protected $table = 'advertisor_custom';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function advertisor() {
        return $this->belongsTo(Advertiser::class ,'advertiser_id');
    }
}
