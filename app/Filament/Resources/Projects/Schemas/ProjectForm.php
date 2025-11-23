<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                // CLIENT
                Select::make('client_id')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),

                // SERVICE
                Select::make('service_id')
                    ->relationship('service', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
                    ->columnSpanFull(),

                // SUBSERVICE (filtered by service)
                Select::make('sub_service_id')
                    ->relationship('subService', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull()
                    ->reactive()
                    ->visible(fn ($get) => $get('service_id')),

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

                // SUMMARY
                Textarea::make('summary')
                    ->rows(3)
                    ->columnSpanFull(),

                // DESCRIPTION
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

                // STATUS
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'active' => 'Active',
                        'completed' => 'Completed',
                    ])
                    ->default('draft'),

                // DATES
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),

                // FEATURED IMAGE
                FileUpload::make('featured_image')
                    ->directory('projects')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpanFull(),

                // DELIVERABLES (Repeater)
                Repeater::make('deliverables')
                    ->schema([
                        TextInput::make('title')->required(),
                        Textarea::make('description')->rows(2),
                    ])
                    ->columnSpanFull(),

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
                    ->placeholder('web development, branding, startup clinic')
                    ->columnSpanFull(),
            ]);
    }
}
