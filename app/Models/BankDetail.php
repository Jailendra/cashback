<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'bank_name', 'branch_name', 'account_name', 'account_number', 'swift', 'iban'];
    protected $table = "bank_details";
}
