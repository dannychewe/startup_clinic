<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'title',
        'content',
        'image',
        'order',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}