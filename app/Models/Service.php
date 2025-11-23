<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'slug', 'short_description', 'description', 'icon', 'featured_image',  'seo_title', 'seo_description', 'seo_keywords',
    ];

    public function subServices()
    {
        return $this->hasMany(SubService::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

