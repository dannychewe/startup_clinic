<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AboutInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('mission'),
            TextEntry::make('vision'),
        ]);
    }
}
