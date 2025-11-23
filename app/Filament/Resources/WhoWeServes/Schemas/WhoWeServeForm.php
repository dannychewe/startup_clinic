<?php

namespace App\Filament\Resources\WhoWeServes\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class WhoWeServeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    })
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabled(fn($context) => $context === 'edit')
                    ->columnSpanFull(),

                RichEditor::make('description')
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'bulletList',
                        'orderedList',
                        'link',
                        'blockquote',
                        'undo',
                        'redo',
                    ]),

                FileUpload::make('image')
                    ->directory('who-we-serve/images')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpan(1),

                FileUpload::make('icon')
                    ->directory('who-we-serve/icons')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
