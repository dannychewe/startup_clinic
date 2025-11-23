<?php

namespace App\Filament\Resources\Newsletters\Schemas;

use Filament\Infolists;
use Filament\Schemas\Schema;

class NewsletterInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Infolists\Components\TextEntry::make('email')->label('Email'),
            Infolists\Components\TextEntry::make('ip')->label('IP Address'),
            Infolists\Components\TextEntry::make('created_at')->label('Subscribed On'),
        ]);
    }
}
