<?php

namespace App\Filament\Resources\HealthChecks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HealthChecksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Submitted By'),

                TextColumn::make('company')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('score')
                    ->badge()
                    ->colors([
                        'danger' => fn ($state) => $state < 40,
                        'warning' => fn ($state) => $state >= 40 && $state < 70,
                        'success' => fn ($state) => $state >= 70,
                    ]),

                TextColumn::make('created_at')
                    ->label('Submitted On')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])

            ->defaultSort('created_at', 'desc')

            ->recordActions([
                ViewAction::make(),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
