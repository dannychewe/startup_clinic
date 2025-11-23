<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // NAME
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->limit(30)
                    ->weight('bold'),

                // SLUG
                TextColumn::make('slug')
                    ->searchable()
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                // SHORT DESCRIPTION
                TextColumn::make('short_description')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: false),

                // ICON (show as image, not text)
                ImageColumn::make('icon')
                    ->label('Icon')
                    ->size(30),

                // FEATURED IMAGE
                ImageColumn::make('featured_image')
                    ->label('Image')
                    ->size(50),

                // CREATED AT
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // UPDATED AT
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            // 📌 Default sorting: newest first
            ->defaultSort('created_at', 'desc')

            // FILTERS
            ->filters([])

            // ROW ACTIONS
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])

            // BULK ACTIONS
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
