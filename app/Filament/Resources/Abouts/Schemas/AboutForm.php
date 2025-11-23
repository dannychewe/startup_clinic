<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AboutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                FileUpload::make('featured_image')
                    ->directory('about')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpanFull(),

                RichEditor::make('founder_message')
                    ->label('Message From the Founders')
                    ->columnSpanFull(),

                RichEditor::make('story')
                    ->label('Our Story')
                    ->columnSpanFull(),

                RichEditor::make('mission')
                    ->label('Mission')
                    ->columnSpanFull(),

                RichEditor::make('vision')
                    ->label('Vision')
                    ->columnSpanFull(),

                RichEditor::make('philosophy')
                    ->label('Philosophy & Approach')
                    ->columnSpanFull(),

                Repeater::make('values')
                    ->label('Core Values')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('title')->required(),
                        TextInput::make('description')->required(),
                    ]),
            ]);
    }
}
