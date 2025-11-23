<?php

namespace App\Filament\Resources\Newsletters\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class NewsletterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->disabled(),

                Forms\Components\TextInput::make('ip')
                    ->label('IP Address')
                    ->disabled(),
            ]);
    }
}
