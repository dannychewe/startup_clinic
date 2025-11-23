<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contact Message Details')
                ->schema([
                    TextEntry::make('name')->label('Sender'),
                    TextEntry::make('email'),
                    TextEntry::make('phone')->label('Phone')->default('-'),
                    TextEntry::make('subject')->label('Subject'),
                    TextEntry::make('message')->label('Message')->columnSpanFull(),
                    TextEntry::make('created_at')->label('Received On'),
                ])
        ]);
    }
}
