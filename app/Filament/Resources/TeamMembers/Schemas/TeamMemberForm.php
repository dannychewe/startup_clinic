<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                FileUpload::make('photo')
                    ->directory('team/photos')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->avatar()
                    ->columnSpanFull(),

                RichEditor::make('bio')
                    ->label('Biography')
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

                TextInput::make('email')
                    ->email()
                    ->nullable(),

                TextInput::make('linkedin')
                    ->url()
                    ->label('LinkedIn URL')
                    ->nullable(),

                TextInput::make('order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
