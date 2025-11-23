<?php

namespace App\Filament\Resources\FooterItems;

use App\Filament\Resources\FooterItems\Pages\CreateFooterItem;
use App\Filament\Resources\FooterItems\Pages\EditFooterItem;
use App\Filament\Resources\FooterItems\Pages\ListFooterItems;
use App\Filament\Resources\FooterItems\Pages\ViewFooterItem;
use App\Filament\Resources\FooterItems\Schemas\FooterItemForm;
use App\Filament\Resources\FooterItems\Schemas\FooterItemInfolist;
use App\Filament\Resources\FooterItems\Tables\FooterItemsTable;
use App\Models\FooterItem;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FooterItemResource extends Resource
{
    protected static ?string $model = FooterItem::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedLink;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationGroup(): ?string
    {
        return 'Website Settings';
    }

    public static function getLabel(): ?string
    {
        return 'Footer Item';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Footer Items';
    }

    public static function form(Schema $schema): Schema
    {
        return FooterItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FooterItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FooterItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListFooterItems::route('/'),
            'create' => CreateFooterItem::route('/create'),
            'view'   => ViewFooterItem::route('/{record}'),
            'edit'   => EditFooterItem::route('/{record}/edit'),
        ];
    }
}
