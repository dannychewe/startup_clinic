<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('email')
                    ->email()
                    ->nullable(),

                TextInput::make('phone')
                    ->tel()
                    ->nullable(),

                TextInput::make('company_name')
                    ->label('Company Name')
                    ->nullable()
                    ->columnSpanFull(),

                TextInput::make('website')
                    ->url()
                    ->nullable(),

                TextInput::make('industry')
                    ->nullable(),

                FileUpload::make('logo')
                    ->directory('clients/logos')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpan(1),

                Textarea::make('notes')
                    ->label('Notes / Extra Information')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
