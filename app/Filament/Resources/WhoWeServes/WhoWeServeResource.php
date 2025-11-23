<?php

namespace App\Filament\Resources\WhoWeServes;

use App\Filament\Resources\WhoWeServes\Pages\CreateWhoWeServe;
use App\Filament\Resources\WhoWeServes\Pages\EditWhoWeServe;
use App\Filament\Resources\WhoWeServes\Pages\ListWhoWeServes;
use App\Filament\Resources\WhoWeServes\Pages\ViewWhoWeServe;
use App\Filament\Resources\WhoWeServes\Schemas\WhoWeServeForm;
use App\Filament\Resources\WhoWeServes\Schemas\WhoWeServeInfolist;
use App\Filament\Resources\WhoWeServes\Tables\WhoWeServesTable;
use App\Models\WhoWeServe;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WhoWeServeResource extends Resource
{
    protected static ?string $model = WhoWeServe::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return 'People';
    }

    public static function getLabel(): ?string
    {
        return 'Who We Serve';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Who We Serve';
    }

    public static function form(Schema $schema): Schema
    {
        return WhoWeServeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WhoWeServeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WhoWeServesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListWhoWeServes::route('/'),
            'create' => CreateWhoWeServe::route('/create'),
            'view'   => ViewWhoWeServe::route('/{record}'),
            'edit'   => EditWhoWeServe::route('/{record}/edit'),
        ];
    }
}
