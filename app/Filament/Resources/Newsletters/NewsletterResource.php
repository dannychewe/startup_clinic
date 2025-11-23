<?php

namespace App\Filament\Resources\Newsletters;

use App\Filament\Resources\Newsletters\Pages\CreateNewsletter;
use App\Filament\Resources\Newsletters\Pages\EditNewsletter;
use App\Filament\Resources\Newsletters\Pages\ListNewsletters;
use App\Filament\Resources\Newsletters\Pages\ViewNewsletter;
use App\Filament\Resources\Newsletters\Schemas\NewsletterForm;
use App\Filament\Resources\Newsletters\Schemas\NewsletterInfolist;
use App\Filament\Resources\Newsletters\Tables\NewslettersTable;

use App\Models\Newsletter;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class NewsletterResource extends Resource
{
    protected static ?string $model = Newsletter::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    // Display email on title bar
    protected static ?string $recordTitleAttribute = 'email';

    /**
     * Form schema
     */
    public static function form(Schema $schema): Schema
    {
        return NewsletterForm::configure($schema);
    }

    /**
     * View (Infolist) schema
     */
    public static function infolist(Schema $schema): Schema
    {
        return NewsletterInfolist::configure($schema);
    }

    /**
     * Table schema
     */
    public static function table(Table $table): Table
    {
        return NewslettersTable::configure($table);
    }

    /**
     * No relations for now
     */
    public static function getRelations(): array
    {
        return [];
    }

    /**
     * Pages inside Newsletter Resource
     */
    public static function getPages(): array
    {
        return [
            'index'  => ListNewsletters::route('/'),
            'create' => CreateNewsletter::route('/create'),
            'view'   => ViewNewsletter::route('/{record}'),
            'edit'   => EditNewsletter::route('/{record}/edit'),
        ];
    }
}
