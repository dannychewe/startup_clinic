<?php
namespace App\Filament\Resources\SubServices;

use BackedEnum;
use App\Filament\Resources\SubServices\Pages\CreateSubService;
use App\Filament\Resources\SubServices\Pages\EditSubService;
use App\Filament\Resources\SubServices\Pages\ListSubServices;
use App\Filament\Resources\SubServices\Pages\ViewSubService;
use App\Filament\Resources\SubServices\Schemas\SubServiceForm;
use App\Filament\Resources\SubServices\Schemas\SubServiceInfolist;
use App\Filament\Resources\SubServices\Tables\SubServicesTable;
use App\Models\SubService;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubServiceResource extends Resource
{
    protected static ?string $model = SubService::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return 'Services & Projects';
    }

    public static function getLabel(): ?string
    {
        return 'Sub Service';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Sub Services';
    }

    public static function form(Schema $schema): Schema
    {
        return SubServiceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubServiceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubServicesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListSubServices::route('/'),
            'create' => CreateSubService::route('/create'),
            'view'   => ViewSubService::route('/{record}'),
            'edit'   => EditSubService::route('/{record}/edit'),
        ];
    }
}
