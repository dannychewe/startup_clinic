<?php

namespace App\Filament\Resources\Newsletters\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Facades\Mail;

class NewslettersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('ip')
                    ->label('IP Address')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Subscribed')
                    ->dateTime()
                    ->sortable(),
            ])

            ->defaultSort('created_at', 'desc')

            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])

            ->bulkActions([
                BulkActionGroup::make([

                    BulkAction::make('sendNewsletter')
                        ->label('Send Newsletter Email')
                        ->icon('heroicon-o-paper-airplane')
                        ->form([
                            Forms\Components\TextInput::make('subject')
                                ->label('Email Subject')
                                ->required(),

                            Forms\Components\RichEditor::make('message')
                                ->label('Email Message')
                                ->required(),
                        ])
                        ->action(function ($data, $records) {
                            foreach ($records as $subscriber) {
                                Mail::send([], [], function ($mail) use ($subscriber, $data) {
                                    $mail->to($subscriber->email)
                                        ->subject($data['subject'])
                                        ->html($data['message']);
                                });
                            }
                        }),

                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
