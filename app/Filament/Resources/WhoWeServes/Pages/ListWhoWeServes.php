<?php

namespace App\Filament\Resources\WhoWeServes\Pages;

use App\Filament\Resources\WhoWeServes\WhoWeServeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWhoWeServes extends ListRecords
{
    protected static string $resource = WhoWeServeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
