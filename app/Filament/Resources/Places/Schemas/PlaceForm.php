<?php

namespace App\Filament\Resources\Places\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PlaceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('address')
                    ->required(),
            ]);
    }
}
