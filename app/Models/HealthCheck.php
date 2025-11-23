<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthCheck extends Model
{
    protected $fillable = [
        'client_id',
        'answers',
        'scores',
        'overall_score',
        'recommendations',
        'report_path',
    ];

    protected $casts = [
        'answers' => 'array',
        'scores' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}