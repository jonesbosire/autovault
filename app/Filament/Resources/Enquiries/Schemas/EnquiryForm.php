<?php

namespace App\Filament\Resources\Enquiries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('vehicle_id')->relationship('vehicle', 'title')->required()->searchable()->preload(),
            TextInput::make('name')->required(),
            TextInput::make('email')->label('Email address')->email()->required(),
            TextInput::make('phone')->tel(),
            Textarea::make('message')->required()->columnSpanFull(),
            Select::make('status')->options([
                'new'      => 'New',
                'read'     => 'Read',
                'replied'  => 'Replied',
                'archived' => 'Archived',
            ])->default('new')->required(),
            TextInput::make('ip_address')->label('IP Address')->disabled(),
        ]);
    }
}
