<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'currency', 'dob', 'mobile_number', 'gender', 'pan', 'display_name', 'country', 'language'];
    protected $table = "user_profiles";

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    // protected $keyType = 'int';

    public function user () {
        return $this->belongsTo (\App\User::class, 'user_id');
    }
}
