<?php

namespace App\Filament\Resources\HealthChecks\Schemas;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Schema;

class HealthCheckInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            
            Section::make('Basic Info')
                ->schema([
                    TextEntry::make('name'),
                    TextEntry::make('email'),
                    TextEntry::make('company'),
                    TextEntry::make('score')
                        ->label('Final Score'),
                ]),

            Section::make('Submitted Answers')
                ->schema([
                    RepeatableEntry::make('answers')
                        ->schema([
                            TextEntry::make('question'),
                            TextEntry::make('answer'),
                            TextEntry::make('score'),
                        ]),
                ]),

            Section::make('Submitted On')
                ->schema([
                    TextEntry::make('created_at')->dateTime(),
                ]),
        ]);
    }
}
