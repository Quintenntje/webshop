<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Translatable\HasTranslations;

class Gender extends Model implements Sitemapable
{
    use HasTranslations;

    protected $fillable = ['name', 'slug'];

    public $translatable = ['name'];

    public function toSitemapTag(): Url|string|array
    {
        return Url::create("/shoes/{$this->slug}")
            ->setLastModificationDate($this->updated_at ?? now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8);
    }
}
