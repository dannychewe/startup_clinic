<?php

namespace App\Filament\Resources\Abouts\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AboutTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Record')->sortable(),
                TextColumn::make('updated_at')->dateTime()->label('Last Updated'),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
