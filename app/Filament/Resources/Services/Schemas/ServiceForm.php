<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                // NAME
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    })
                    ->columnSpanFull(),

                // SLUG
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabled(fn($context) => $context === 'edit')
                    ->columnSpanFull(),

                // SHORT DESCRIPTION
                Textarea::make('short_description')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),

                // DESCRIPTION (Rich Editor)
                RichEditor::make('description')
                    ->label('Detailed Description')
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'h2',
                        'h3',
                        'bulletList',
                        'orderedList',
                        'link',
                        'blockquote',
                        'undo',
                        'redo',
                    ]),

                // ICON
                FileUpload::make('icon')
                    ->label('Icon (SVG or Image)')
                    ->directory('services/icons')
                    ->acceptedFileTypes(['image/svg+xml', 'image/png', 'image/jpeg'])
                    ->columnSpan(1),

                // FEATURED IMAGE
                FileUpload::make('featured_image')
                    ->directory('services')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpan(1),

                // ============================
                //        SEO FIELDS
                // ============================

                TextInput::make('seo_title')
                    ->label('SEO Title')
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('seo_description')
                    ->label('SEO Description')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('seo_keywords')
                    ->label('SEO Keywords (comma separated)')
                    ->placeholder('digital marketing, startup clinic, services')
                    ->columnSpanFull(),
            ]);
    }
}
