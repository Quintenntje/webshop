<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'expires_at',
        'active',
    ];

    public function isValid(): bool
    {
        return $this->active && $this->expires_at && $this->expires_at >= now();
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
