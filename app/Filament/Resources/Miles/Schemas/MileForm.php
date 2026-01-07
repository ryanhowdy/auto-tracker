<?php

namespace App\Filament\Resources\Miles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class MileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_id')
                    ->label('Vehicle')
                    ->relationship('vehicle', 'name')
                    ->required(),
                TextInput::make('miles')
                    ->required()
                    ->numeric(),
            ]);
    }
}
