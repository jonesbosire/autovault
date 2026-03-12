<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
            TextInput::make('email')->label('Email address')->email()->required()->unique(ignoreRecord: true),
            TextInput::make('phone')->tel(),
            Select::make('role')->options([
                'seller'      => 'Seller',
                'admin'       => 'Admin',
                'super_admin' => 'Super Admin',
            ])->default('seller')->required(),
            Select::make('status')->options([
                'active'    => 'Active',
                'suspended' => 'Suspended',
            ])->default('active')->required(),
            Toggle::make('is_verified')->label('KYC Verified')->inline(false),
            TextInput::make('id_number')->label('ID / Passport Number'),
            TextInput::make('password')->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context) => $context === 'create')
                ->label('Password (leave blank to keep)'),
        ]);
    }
}
