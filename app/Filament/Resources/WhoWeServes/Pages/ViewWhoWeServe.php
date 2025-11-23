<?php

namespace App\Filament\Resources\WhoWeServes\Pages;

use App\Filament\Resources\WhoWeServes\WhoWeServeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWhoWeServe extends ViewRecord
{
    protected static string $resource = WhoWeServeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
