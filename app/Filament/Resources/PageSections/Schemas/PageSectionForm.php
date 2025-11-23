<?php

namespace App\Filament\Resources\PageSections\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                // Relation: Page
                Select::make('page_id')
                    ->relationship('page', 'title')
                    ->required()
                    ->searchable()
                    ->columnSpanFull(),

                // Section title
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // Type of section
                Select::make('section_type')
                    ->options([
                        'text' => 'Text Only',
                        'image_left' => 'Image Left + Text',
                        'image_right' => 'Image Right + Text',
                        'cta' => 'Call to Action',
                        'metrics' => 'Metrics / Statistics',
                        'gallery' => 'Image Gallery',
                        'custom' => 'Custom HTML Block',
                    ])
                    ->required()
                    ->reactive(),

                // Body (text content)
                RichEditor::make('body')
                    ->label('Content')
                    ->columnSpanFull()
                    ->visible(fn ($get) => in_array($get('section_type'), [
                        'text',
                        'image_left',
                        'image_right',
                        'cta',
                        'custom',
                    ])),

                // CTA Button fields
                TextInput::make('button_text')
                    ->visible(fn ($get) => $get('section_type') === 'cta'),

                TextInput::make('button_link')
                    ->visible(fn ($get) => $get('section_type') === 'cta'),

                // Metrics (JSON)
                Textarea::make('metrics')
                    ->label('Metrics (JSON)')
                    ->placeholder('[{"label":"Clients","value":120}]')
                    ->visible(fn ($get) => $get('section_type') === 'metrics')
                    ->columnSpanFull(),

                // Image upload
                FileUpload::make('image')
                    ->directory('page-sections/images')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->visible(fn ($get) => in_array($get('section_type'), [
                        'image_left',
                        'image_right',
                        'gallery',
                    ]))
                    ->columnSpanFull(),

                // Gallery images
                FileUpload::make('gallery')
                    ->directory('page-sections/gallery')
                    ->multiple()
                    ->disk('public')
                    ->visibility('public')
                    ->image()
                    ->columnSpanFull()
                    ->visible(fn ($get) => $get('section_type') === 'gallery'),

                // Sort order
                TextInput::make('order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
