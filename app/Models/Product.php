<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements Sitemapable
{
    use HasTranslations;

    protected $fillable = ['name', 'slug', 'description', 'price', 'gender_id', 'brand_id', 'category_id'];

    public $translatable = [ 'description'];

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

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getAvailableColors()
    {
        return ProductColor::whereIn('id', $this->variants->pluck('color_id')->unique())->get();
    }

    public function getAvailableSizesForColor($colorId)
    {
        return ProductSize::whereIn(
            'id',
            $this->variants->where('color_id', $colorId)->pluck('size_id')->unique()
        )->get();
    }

    public function getVariantByColorAndSize($colorId, $sizeId)
    {
        return $this->variants()
            ->where('color_id', $colorId)
            ->where('size_id', $sizeId)
            ->first();
    }

    public function isSizeInStockForColor($colorId, $sizeId)
    {
        $variant = $this->getVariantByColorAndSize($colorId, $sizeId);
        return $variant && $variant->inStock();
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
