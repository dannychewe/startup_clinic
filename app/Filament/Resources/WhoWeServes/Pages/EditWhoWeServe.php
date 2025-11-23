<?php

namespace App\Filament\Resources\WhoWeServes\Pages;

use App\Filament\Resources\WhoWeServes\WhoWeServeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWhoWeServe extends EditRecord
{
    protected static string $resource = WhoWeServeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
