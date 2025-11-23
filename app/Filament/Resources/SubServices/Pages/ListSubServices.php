<?php

namespace App\Filament\Resources\SubServices\Pages;

use App\Filament\Resources\SubServices\SubServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSubServices extends ListRecords
{
    protected static string $resource = SubServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
