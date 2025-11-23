<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(2)->components([

            TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            TextInput::make('email')
                ->email()
                ->unique(ignoreRecord: true)
                ->required()
                ->columnSpanFull(),

            // Password only required when creating a user
            TextInput::make('password')
                ->password()
                ->revealable()
                ->required(fn ($context) => $context === 'create')
                ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null)
                ->dehydrated(fn ($state) => filled($state))
                ->columnSpanFull(),

            // Avatar upload
            FileUpload::make('avatar')
                ->directory('users/avatars')
                ->image()
                ->disk('public')
                ->visibility('public')
                ->columnSpanFull(),
        ]);
    }
}
