<?php

namespace App\Filament\Resources\HealthChecks;

use App\Filament\Resources\HealthChecks\Pages\ListHealthChecks;
use App\Filament\Resources\HealthChecks\Pages\ViewHealthCheck;
use App\Filament\Resources\HealthChecks\Schemas\HealthCheckInfolist;
use App\Filament\Resources\HealthChecks\Tables\HealthChecksTable;
use App\Models\HealthCheck;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HealthCheckResource extends Resource
{
    protected static ?string $model = HealthCheck::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $recordTitleAttribute = 'name';

    // Group under analytics
    public static function getNavigationGroup(): ?string
    {
        return 'Analytics & Diagnostics';
    }

    public static function getLabel(): ?string
    {
        return 'Health Check';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Health Checks';
    }

    // ❌ Disable creation and editing
    public static function canCreate(): bool { return false; }
    public static function canEdit($record): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        // Forms not used for editing
        return HealthCheckInfolist::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HealthCheckInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HealthChecksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHealthChecks::route('/'),
            'view'  => ViewHealthCheck::route('/{record}'),
        ];
    }
}
