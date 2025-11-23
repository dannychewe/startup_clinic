<?php

namespace App\Filament\Resources\HeroSections\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HeroSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                // 🎯 Page key (home, about, services, contact, etc.)
                TextInput::make('page')
                    ->required()
                    ->placeholder('home, about, services, contact')
                    ->columnSpanFull(),

                // Title
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // Subtitle
                Textarea::make('subtitle')
                    ->rows(2)
                    ->columnSpanFull(),

                // CTA Button Text
                TextInput::make('button_text')
                    ->nullable(),

                // CTA Link
                TextInput::make('button_link')
                    ->nullable(),

                // Background Image / Hero Graphic
                FileUpload::make('background_image')
                    ->directory('hero/backgrounds')
                    ->disk('public')
                    ->visibility('public')
                    ->image()
                    ->columnSpanFull(),
            ]);
    }
}
