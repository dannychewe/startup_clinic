<?php

namespace App\Filament\Resources\HealthChecks\Pages;

use App\Filament\Resources\HealthChecks\HealthCheckResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditHealthCheck extends EditRecord
{
    protected static string $resource = HealthCheckResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
