<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhoWeServe extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'icon',
        'order',
    ];
}