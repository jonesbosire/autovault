<?php

namespace App\Filament\Resources\SubscriptionPlans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubscriptionPlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('price_monthly')
                    ->required()
                    ->numeric(),
                TextInput::make('max_listings')
                    ->required()
                    ->numeric(),
                TextInput::make('listing_duration_days')
                    ->required()
                    ->numeric()
                    ->default(60),
                Toggle::make('has_featured_placement')
                    ->required(),
                Toggle::make('has_auto_score')
                    ->required(),
                Toggle::make('has_verified_badge')
                    ->required(),
                Toggle::make('has_priority_review')
                    ->required(),
                Toggle::make('has_api_access')
                    ->required(),
                TextInput::make('boost_credits')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('features')
                    ->default(null)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
