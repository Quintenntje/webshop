<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Brand extends Model implements Sitemapable
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function toSitemapTag(): Url|string|array
    {
        return Url::create("/brand/{$this->slug}")
            ->setLastModificationDate($this->updated_at ?? now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8);
    }
}
