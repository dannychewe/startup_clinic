<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                // TITLE
                TextInput::make('title')
                    ->required()
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

                // STATUS
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft'),

                // PUBLISH DATE
                DateTimePicker::make('published_at')
                    ->nullable(),

                // EXCERPT
                Textarea::make('excerpt')
                    ->rows(3)
                    ->columnSpanFull(),

                // FEATURED IMAGE
                FileUpload::make('featured_image')
                    ->directory('pages/featured')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpanFull(),

                // BODY CONTENT
                RichEditor::make('body')
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

                // SEO TITLE
                TextInput::make('seo_title')
                    ->maxLength(255)
                    ->label('SEO Title'),

                // SEO DESCRIPTION
                Textarea::make('seo_description')
                    ->label('SEO Description')
                    ->rows(3)
                    ->columnSpanFull(),

                // SEO KEYWORDS
                TextInput::make('seo_keywords')
                    ->label('SEO Keywords (comma separated)')
                    ->columnSpanFull(),
            ]);
    }
}
