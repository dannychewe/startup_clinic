<?php

namespace App\Filament\Resources\SubServices\Pages;

use App\Filament\Resources\SubServices\SubServiceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSubService extends ViewRecord
{
    protected static string $resource = SubServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
