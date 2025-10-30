<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProductDiscount extends Model
{
    protected $fillable = [
        'product_id',
        'type',
        'value',
        'start_date',
        'expire_date',
        'active',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isValid(): bool
    {
        if (!$this->active) {
            return false;
        }

        $now = Carbon::now();

        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }

        if ($now->gt($this->expire_date)) {
            return false;
        }

        return true;
    }

    public function calculateDiscountedPrice(float $originalPrice): float
    {
        if (!$this->isValid()) {
            return $originalPrice;
        }

        if ($this->type === 'percentage') {
            $discount = $originalPrice * ($this->value / 100);
            return max(0, $originalPrice - $discount);
        } else {
            return max(0, $originalPrice - $this->value);
        }
    }
}

