<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company_name', 'website', 'industry', 'logo',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function healthChecks()
    {
        return $this->hasMany(HealthCheck::class);
    }
}

