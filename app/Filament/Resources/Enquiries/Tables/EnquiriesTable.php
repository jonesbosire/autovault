<?php

namespace App\Filament\Resources\Enquiries\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class EnquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('vehicle.title')
                    ->label('Vehicle')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('name')
                    ->label('Buyer')
                    ->searchable()
                    ->weight('semibold'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email copied'),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Phone copied'),

                TextColumn::make('message')
                    ->label('Message')
                    ->limit(55)
                    ->tooltip(fn ($record) => $record->message),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new'      => 'warning',
                        'read'     => 'info',
                        'replied'  => 'success',
                        'archived' => 'gray',
                        default    => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])

            ->filters([
                SelectFilter::make('status')->options([
                    'new'      => 'New',
                    'read'     => 'Read',
                    'replied'  => 'Replied',
                    'archived' => 'Archived',
                ]),
            ])

            ->recordActions([
                Action::make('markRead')
                    ->label('Mark Read')
                    ->icon(Heroicon::OutlinedEnvelopeOpen)
                    ->color('info')
                    ->visible(fn ($record) => $record->status === 'new')
                    ->action(function ($record): void {
                        $record->update(['status' => 'read']);
                        Notification::make()
                            ->title('Enquiry marked as read')
                            ->success()
                            ->send();
                    }),

                Action::make('markReplied')
                    ->label('Mark Replied')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->visible(fn ($record) => in_array($record->status, ['new', 'read']))
                    ->action(function ($record): void {
                        $record->update(['status' => 'replied']);
                        Notification::make()
                            ->title('Enquiry marked as replied')
                            ->success()
                            ->send();
                    }),

                Action::make('archive')
                    ->label('Archive')
                    ->icon(Heroicon::OutlinedArchiveBox)
                    ->color('gray')
                    ->visible(fn ($record) => $record->status !== 'archived')
                    ->action(function ($record): void {
                        $record->update(['status' => 'archived']);
                        Notification::make()
                            ->title('Enquiry archived')
                            ->success()
                            ->send();
                    }),

                EditAction::make()->label('Details'),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('bulkMarkRead')
                        ->label('Mark selected as Read')
                        ->icon(Heroicon::OutlinedEnvelopeOpen)
                        ->color('info')
                        ->action(function (Collection $records): void {
                            $records->where('status', 'new')
                                ->each(fn ($r) => $r->update(['status' => 'read']));
                            Notification::make()
                                ->title('Enquiries marked as read')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    DeleteBulkAction::make(),
                ]),
            ])

            ->defaultSort('created_at', 'desc');
    }
}
