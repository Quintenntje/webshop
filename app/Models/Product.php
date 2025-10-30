<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Product extends Model implements Sitemapable
{

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function discounts()
    {
        return $this->hasMany(ProductDiscount::class);
    }

    public function activeDiscount()
    {
        return $this->hasOne(ProductDiscount::class)->where('active', true)->where('expire_date', '>=', now());
    }

    public function getFinalPriceAttribute(): float
    {
        $discount = $this->activeDiscount;

        if ($discount && $discount->isValid()) {
            return $discount->calculateDiscountedPrice((float) $this->price);
        }

        return (float) $this->price;
    }

    public function hasActiveDiscount(): bool
    {
        $discount = $this->activeDiscount;
        return $discount !== null && $discount->isValid();
    }
    public function toSitemapTag(): Url|string|array
    {
        if (!$this->gender || !$this->brand) {
            return [];
        }

        return Url::create("/shoes/{$this->gender->slug}/{$this->id}")
            ->setLastModificationDate($this->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.7);
    }
}
