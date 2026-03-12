<?php

namespace App\Filament\Resources\Vehicles\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class VehiclesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image_url')
                    ->label('Photo')
                    ->width(72)
                    ->height(48)
                    ->defaultImageUrl(asset('assets/images/section/slider-listing1.jpg'))
                    ->extraImgAttributes(['style' => 'object-fit:cover;border-radius:6px;']),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(36)
                    ->description(fn ($record) => ($record->brand?->name ?? '') . ' · ' . $record->year),

                TextColumn::make('price')
                    ->money('KES')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active'          => 'success',
                        'pending_review'  => 'warning',
                        'pending_payment' => 'info',
                        'draft'           => 'gray',
                        'rejected'        => 'danger',
                        'sold'            => 'primary',
                        'expired'         => 'gray',
                        default           => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('auto_score')
                    ->label('AutoScore™')
                    ->badge()
                    ->color(fn ($state): string => match (true) {
                        $state >= 90 => 'success',
                        $state >= 70 => 'info',
                        $state >= 50 => 'warning',
                        default      => 'danger',
                    })
                    ->sortable(),

                IconColumn::make('is_featured')->label('Featured')->boolean(),
                IconColumn::make('is_verified')->label('Verified')->boolean(),

                TextColumn::make('views_count')->label('Views')->sortable(),
                TextColumn::make('enquiries_count')->label('Enq.')->sortable(),

                TextColumn::make('user.name')
                    ->label('Seller')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Listed')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                SelectFilter::make('status')->options([
                    'draft'           => 'Draft',
                    'pending_review'  => 'Pending Review',
                    'pending_payment' => 'Pending Payment',
                    'active'          => 'Active',
                    'rejected'        => 'Rejected',
                    'sold'            => 'Sold',
                    'expired'         => 'Expired',
                ]),
                SelectFilter::make('condition')->options([
                    'new'          => 'Brand New',
                    'foreign_used' => 'Foreign Used',
                    'locally_used' => 'Locally Used',
                ]),
                TrashedFilter::make(),
            ])

            ->recordActions([
                // ── Approve ────────────────────────────────────────
                Action::make('approve')
                    ->label('Approve')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Listing')
                    ->modalDescription('This will make the listing live and visible to all buyers on AutoVault.')
                    ->modalSubmitActionLabel('Yes, Approve')
                    ->visible(fn ($record) => in_array($record->status, ['pending_review', 'draft', 'rejected', 'pending_payment']))
                    ->action(function ($record): void {
                        $record->update([
                            'status'      => 'active',
                            'approved_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Listing approved')
                            ->body('"' . $record->title . '" is now live on the marketplace.')
                            ->success()
                            ->send();
                    }),

                // ── Reject ─────────────────────────────────────────
                Action::make('reject')
                    ->label('Reject')
                    ->icon(Heroicon::OutlinedXCircle)
                    ->color('danger')
                    ->form([
                        Textarea::make('rejected_reason')
                            ->label('Rejection reason (shown to seller)')
                            ->placeholder('e.g. Missing vehicle photos, incomplete description…')
                            ->required()
                            ->rows(3),
                    ])
                    ->modalHeading('Reject Listing')
                    ->modalSubmitActionLabel('Reject Listing')
                    ->visible(fn ($record) => in_array($record->status, ['pending_review', 'active']))
                    ->action(function ($record, array $data): void {
                        $record->update([
                            'status'          => 'rejected',
                            'rejected_reason' => $data['rejected_reason'],
                        ]);
                        Notification::make()
                            ->title('Listing rejected')
                            ->body('"' . $record->title . '" has been rejected.')
                            ->danger()
                            ->send();
                    }),

                // ── Feature / Unfeature toggle ──────────────────────
                Action::make('toggleFeatured')
                    ->label(fn ($record) => $record->is_featured ? 'Unfeature' : 'Feature')
                    ->icon(Heroicon::OutlinedStar)
                    ->color('warning')
                    ->visible(fn ($record) => $record->status === 'active')
                    ->action(function ($record): void {
                        $wasFeatured = $record->is_featured;
                        $record->update(['is_featured' => ! $wasFeatured]);
                        Notification::make()
                            ->title($wasFeatured ? 'Listing unfeatured' : 'Listing featured')
                            ->body('"' . $record->title . '" ' . ($wasFeatured ? 'removed from' : 'added to') . ' featured listings.')
                            ->success()
                            ->send();
                    }),

                // ── Mark as Sold ────────────────────────────────────
                Action::make('markSold')
                    ->label('Mark Sold')
                    ->icon(Heroicon::OutlinedBanknotes)
                    ->color('primary')
                    ->requiresConfirmation()
                    ->modalHeading('Mark as Sold')
                    ->modalDescription('Mark this vehicle as sold. It will be removed from active listings.')
                    ->visible(fn ($record) => $record->status === 'active')
                    ->action(function ($record): void {
                        $record->update(['status' => 'sold']);
                        Notification::make()
                            ->title('Marked as sold')
                            ->body('"' . $record->title . '" is now marked as sold.')
                            ->success()
                            ->send();
                    }),

                EditAction::make()->label('Edit'),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    // ── Bulk approve ───────────────────────────────
                    \Filament\Actions\BulkAction::make('bulkApprove')
                        ->label('Approve selected')
                        ->icon(Heroicon::OutlinedCheckCircle)
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (\Illuminate\Support\Collection $records): void {
                            $records->each(fn ($r) => $r->update([
                                'status'      => 'active',
                                'approved_at' => now(),
                            ]));
                            Notification::make()
                                ->title($records->count() . ' listing(s) approved')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])

            ->defaultSort('created_at', 'desc');
    }
}
