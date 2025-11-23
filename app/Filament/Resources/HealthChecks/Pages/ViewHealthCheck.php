<?php

namespace App\Filament\Resources\HealthChecks\Pages;

use App\Filament\Resources\HealthChecks\HealthCheckResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHealthCheck extends ViewRecord
{
    protected static string $resource = HealthCheckResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
