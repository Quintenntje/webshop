<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'customer_id',
        'address',
        'city',
        'postal_code',
        'country',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
