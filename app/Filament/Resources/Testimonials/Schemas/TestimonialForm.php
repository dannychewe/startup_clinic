<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                TextInput::make('author_name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('author_role')
                    ->label('Role / Position')
                    ->maxLength(255),

                TextInput::make('company')
                    ->maxLength(255),

                FileUpload::make('photo')
                    ->directory('testimonials/photos')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->avatar()
                    ->columnSpanFull(),

                RichEditor::make('message')
                    ->required()
                    ->columnSpanFull(),

                Select::make('rating')
                    ->options([
                        1 => '⭐☆☆☆☆',
                        2 => '⭐⭐☆☆☆',
                        3 => '⭐⭐⭐☆☆',
                        4 => '⭐⭐⭐⭐☆',
                        5 => '⭐⭐⭐⭐⭐',
                    ])
                    ->label('Rating')
                    ->nullable(),

                Toggle::make('is_featured')
                    ->label('Featured')
                    ->default(false),
            ]);
    }
}
