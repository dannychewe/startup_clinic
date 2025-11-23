<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'client_id', 'service_id', 'sub_service_id',
        'title', 'slug', 'summary', 'description', 'status',
        'start_date', 'end_date', 'featured_image', 'deliverables',  'seo_title', 'seo_description', 'seo_keywords',
    ];

    protected $casts = [
        'deliverables' => 'array',
        'start_date'   => 'date',
        'end_date'     => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function subService()
    {
        return $this->belongsTo(SubService::class);
    }
}
