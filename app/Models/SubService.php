<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    protected $fillable = ['service_id', 'name', 'slug', 'description',  'seo_title', 'seo_description', 'seo_keywords',];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
