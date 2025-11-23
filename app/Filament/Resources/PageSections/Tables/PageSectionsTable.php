<?php

namespace App\Filament\Resources\PageSections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('page.title')
                    ->label('Page')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->limit(40)
                    ->weight('bold'),

                TextColumn::make('section_type')
                    ->badge()
                    ->colors([
                        'primary' => 'text',
                        'info' => 'image_left',
                        'info' => 'image_right',
                        'success' => 'cta',
                        'warning' => 'metrics',
                        'secondary' => 'custom',
                    ])
                    ->sortable(),

                ImageColumn::make('image')
                    ->size(60)
                    ->label('Preview'),

                TextColumn::make('order')
                    ->sortable()
                    ->label('Sort'),

                TextColumn::make('created_at')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->defaultSort('page_id')
            ->defaultSort('order')

            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
