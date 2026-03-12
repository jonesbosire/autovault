<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use App\Services\WatermarkService;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Listing Details')->columns(2)->schema([
                TextInput::make('title')->required()->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                    ->columnSpanFull(),
                TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                Select::make('status')->options([
                    'draft' => 'Draft', 'pending_payment' => 'Pending Payment',
                    'pending_review' => 'Pending Review', 'active' => 'Active',
                    'rejected' => 'Rejected', 'sold' => 'Sold', 'expired' => 'Expired', 'paused' => 'Paused',
                ])->default('active')->required(),
                Select::make('user_id')->relationship('user', 'name')->searchable()->preload()->label('Seller'),
            ]),
            Section::make('Vehicle Specs')->columns(3)->schema([
                Select::make('brand_id')->relationship('brand', 'name')->required()->searchable()->preload()
                    ->reactive()->afterStateUpdated(fn ($set) => $set('car_model_id', null)),
                Select::make('car_model_id')->relationship('carModel', 'name')->required()->searchable()->preload(),
                Select::make('body_type_id')->relationship('bodyType', 'name')->searchable()->preload(),
                TextInput::make('year')->required()->numeric()->minValue(1990)->maxValue(date('Y') + 1),
                TextInput::make('mileage')->required()->numeric()->default(0)->suffix('km'),
                TextInput::make('engine_cc')->label('Engine (cc)')->numeric(),
                Select::make('condition')->options(['new' => 'Brand New', 'foreign_used' => 'Foreign Used', 'locally_used' => 'Locally Used'])->required(),
                Select::make('transmission')->options(['automatic' => 'Automatic', 'manual' => 'Manual', 'cvt' => 'CVT', 'hybrid' => 'Hybrid'])->required(),
                Select::make('fuel_type')->options(['petrol' => 'Petrol', 'diesel' => 'Diesel', 'hybrid' => 'Hybrid', 'electric' => 'Electric', 'lpg' => 'LPG'])->required(),
                Select::make('drive_type')->options(['2wd' => '2WD', '4wd' => '4WD', 'awd' => 'AWD', '4x4' => '4x4']),
                TextInput::make('color')->label('Exterior Color'),
                TextInput::make('interior_color')->label('Interior Color'),
                TextInput::make('doors')->numeric()->default(4),
                TextInput::make('seats')->numeric()->default(5),
            ]),
            Section::make('Pricing & Location')->columns(2)->schema([
                TextInput::make('price')->required()->numeric()->prefix('KES'),
                Toggle::make('is_negotiable')->label('Price Negotiable')->inline(false),
                Select::make('county')->options([
                    'Nairobi' => 'Nairobi', 'Mombasa' => 'Mombasa', 'Kisumu' => 'Kisumu',
                    'Nakuru' => 'Nakuru', 'Eldoret' => 'Eldoret', 'Thika' => 'Thika', 'Other' => 'Other',
                ])->searchable(),
                TextInput::make('location_text')->label('Exact Location')->placeholder('e.g. Westlands, Nairobi'),
                Select::make('availability')->options(['local' => 'Available in Kenya', 'import' => 'Direct Import'])->default('local')->required(),
                TextInput::make('import_country')->label('Import From')->placeholder('e.g. Japan, UAE'),
            ]),
            Section::make('Description')->schema([
                Textarea::make('description')->rows(5)->columnSpanFull(),
            ]),
            Section::make('Listing Controls')->columns(3)->collapsed()->schema([
                Toggle::make('is_featured')->label('Featured')->inline(false),
                Toggle::make('is_verified')->label('Verified')->inline(false),
                Toggle::make('is_boosted')->label('Boosted')->inline(false),
                DateTimePicker::make('boosted_until'),
                DateTimePicker::make('expires_at'),
                DateTimePicker::make('approved_at'),
                TextInput::make('auto_score')->label('AutoScore (0-100)')->numeric()->minValue(0)->maxValue(100),
                Textarea::make('rejected_reason')->columnSpanFull(),
                FileUpload::make('cover_image_file')
                    ->label('Upload Cover Image')
                    ->image()
                    ->disk('public')
                    ->directory('vehicles')
                    ->imageEditor()
                    ->maxSize(4096) // 4 MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('AutoVault watermark is applied automatically. Max 4 MB.')
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $storagePath = $state;
                            // Apply watermark
                            try {
                                $url = app(WatermarkService::class)->applyToStoragePath($storagePath);
                                $set('cover_image_url', $url);
                            } catch (\Throwable $e) {
                                $set('cover_image_url', Storage::url($storagePath));
                            }
                        }
                    })
                    ->dehydrated(false) // don't save this field to DB directly
                    ->columnSpanFull(),
                TextInput::make('cover_image_url')
                    ->label('Cover Image URL (auto-filled on upload, or paste external URL)')
                    ->url()
                    ->columnSpanFull(),
            ]),
        ]);
    }
}