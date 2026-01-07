<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->placeholder('My Car'),
                Select::make('type')
                    ->options(['car' => 'Car', 'suv' => 'Suv', 'truck' => 'Truck', 'van' => 'Van']),
                TextInput::make('manufacturer')
                    ->required(),
                TextInput::make('model')
                    ->required(),
                TextInput::make('year')
                    ->numeric(),
                TextInput::make('license')
                    ->extraInputAttributes([
                        'style' => 'text-transform:uppercase',
                        'autocapitalize' => 'characters',
                    ]),
                TextInput::make('vin')
                    ->extraInputAttributes([
                        'style' => 'text-transform:uppercase',
                        'autocapitalize' => 'characters',
                    ]),
                Textarea::make('notes')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['A' => 'Active', 'D' => 'Disabled'])
                    ->default('A')
                    ->required(),
            ]);
    }
}
