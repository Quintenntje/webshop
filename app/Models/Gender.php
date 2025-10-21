<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Gender extends Model implements Sitemapable
{
    public function toSitemapTag(): Url|string|array
    {
        return Url::create("/shoes/{$this->slug}")
            ->setLastModificationDate($this->updated_at ?? now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8);
    }
}
