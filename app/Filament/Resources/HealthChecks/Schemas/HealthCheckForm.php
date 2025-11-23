<?php

namespace App\Filament\Resources\HealthChecks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HealthCheckForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('client_id')
                    ->numeric()
                    ->default(null),
                Textarea::make('answers')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('scores')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('overall_score')
                    ->numeric()
                    ->default(null),
                Textarea::make('recommendations')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('report_path')
                    ->default(null),
            ]);
    }
}
