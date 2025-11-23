<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'body',
        'featured_image',
        'status',
        'seo_title', 'seo_description', 'seo_keywords',
    ];

    public function sections()
    {
        return $this->hasMany(PageSection::class);
    }
}