<?php

namespace App\Filament\Resources\PageSections;

use App\Filament\Resources\PageSections\Pages\CreatePageSection;
use App\Filament\Resources\PageSections\Pages\EditPageSection;
use App\Filament\Resources\PageSections\Pages\ListPageSections;
use App\Filament\Resources\PageSections\Pages\ViewPageSection;
use App\Filament\Resources\PageSections\Schemas\PageSectionForm;
use App\Filament\Resources\PageSections\Schemas\PageSectionInfolist;
use App\Filament\Resources\PageSections\Tables\PageSectionsTable;
use App\Models\PageSection;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PageSectionResource extends Resource
{
    protected static ?string $model = PageSection::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedViewColumns;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationGroup(): ?string
    {
        return 'Website Content';
    }

    public static function getLabel(): ?string
    {
        return 'Page Section';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Page Sections';
    }

    public static function form(Schema $schema): Schema
    {
        return PageSectionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PageSectionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PageSectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPageSections::route('/'),
            'create' => CreatePageSection::route('/create'),
            'view'   => ViewPageSection::route('/{record}'),
            'edit'   => EditPageSection::route('/{record}/edit'),
        ];
    }
}
