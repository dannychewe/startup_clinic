<?php

namespace App\Filament\Resources\HeroSections\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HeroSectionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('page'),
                TextEntry::make('title'),
                TextEntry::make('subtitle')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('button_text')
                    ->placeholder('-'),
                TextEntry::make('button_link')
                    ->placeholder('-'),
                ImageEntry::make('background_image')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
