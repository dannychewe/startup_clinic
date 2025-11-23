<?php

namespace App\Filament\Resources\Abouts;

use App\Filament\Resources\Abouts\Pages\ManageAbouts;
use App\Models\About;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    protected static ?string $recordTitleAttribute = 'id'; // single record

    public static function getNavigationGroup(): ?string
    {
        return 'Website Settings';
    }

    public static function getLabel(): ?string
    {
        return 'About Page';
    }

    public static function getPluralLabel(): ?string
    {
        return 'About Page';
    }

    // Disable Create/Delete
    public static function canCreate(): bool { return false; }
    public static function canDelete($record): bool { return false; }
    public static function canDeleteAny(): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return \App\Filament\Resources\Abouts\Schemas\AboutForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return \App\Filament\Resources\Abouts\Schemas\AboutInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return \App\Filament\Resources\Abouts\Tables\AboutTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAbouts::route('/'),
        ];
    }
}
