<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $fillable = [
        'customer_id',
        'code',
        'expire_time',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }   
}
