<?php

namespace App\Filament\Resources\HealthChecks\Pages;

use App\Filament\Resources\HealthChecks\HealthCheckResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHealthCheck extends CreateRecord
{
    protected static string $resource = HealthCheckResource::class;
}
