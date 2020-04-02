<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;

class User extends Authenticatable {
    use Notifiable, SoftDeletes;
    use Billable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'email', 'password', 'email_verified_at', 'role', 'refered_by', 'reference_code', 'remember_token'];

    public function referBy () {
        return $this->belongsTo(User::class, 'refered_by');
    }

    public function referrals () {
        return $this->hasMany (User::class, 'refered_by');
    }

    public function commissions () {
        return $this->hasMany (Models\CommissionReceived::class, 'user_id');
    }

    public function profile () {
        return $this->hasOne (Models\UserProfile::class, 'user_id');
    }

    public function subscription () {
        return $this->hasMany(\Laravel\Cashier\Subscription::class, 'user_id');
    }

    public function bank(){
        return $this->hasOne(Models\BankDetail::class, 'user_id');
    }


}
