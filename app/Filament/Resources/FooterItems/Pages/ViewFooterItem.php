<?php

namespace App\Filament\Resources\FooterItems\Pages;

use App\Filament\Resources\FooterItems\FooterItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFooterItem extends ViewRecord
{
    protected static string $resource = FooterItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
