<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'founder_message',
        'story',
        'mission',
        'vision',
        'philosophy',
        'values',
        'featured_image',
    ];

    protected $casts = [
        'values' => 'array',
    ];
}