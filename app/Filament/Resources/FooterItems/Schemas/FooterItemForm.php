<?php

namespace App\Filament\Resources\FooterItems\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FooterItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                // LABEL (required in migration)
                TextInput::make('label')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // TYPE (required in migration)
                Select::make('type')
                    ->options([
                        'link'    => 'Link',
                        'social'  => 'Social Media',
                        'contact' => 'Contact Info',
                        'text'    => 'Text Block',
                        'menu'    => 'Footer Menu Item',
                    ])
                    ->required()
                    ->columnSpan(1),

                // VALUE (text, phone, email, address, etc.)
                TextInput::make('value')
                    ->label('Value (Text / Phone / Email / Address)')
                    ->maxLength(255)
                    ->columnSpanFull(),

                // URL (for link or social)
                TextInput::make('url')
                    ->label('URL (if applicable)')
                    ->placeholder('https://example.com or /services')
                    ->columnSpanFull(),

                // ICON
                FileUpload::make('icon')
                    ->directory('footer/icons')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpan(1),

                // ORDER
                TextInput::make('order')
                    ->numeric()
                    ->default(0),

                // ACTIVE?
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
