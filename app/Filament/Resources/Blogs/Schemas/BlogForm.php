<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                // CATEGORY
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),

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

                // AUTHOR
                Select::make('author_id')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Author')
                    ->required(),

                // STATUS
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->columnSpan(1),

                // PUBLISHED DATE
                DateTimePicker::make('published_at')
                    ->seconds(false)
                    ->nullable()
                    ->columnSpan(1),

                // EXCERPT
                Textarea::make('excerpt')
                    ->rows(3)
                    ->columnSpanFull(),

                // FEATURED IMAGE
                FileUpload::make('featured_image')
                    ->directory('blogs/featured')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpanFull(),

                // BODY
                RichEditor::make('body')
                    ->label('Blog Content')
                    ->required()
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

                // ============================
                //          SEO FIELDS
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
                    ->placeholder('entrepreneurship, marketing, business growth')
                    ->columnSpanFull(),
            ]);
    }
}
