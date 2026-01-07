<?php

namespace App\Filament\Resources\ServiceHistories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Schema;

class ServiceHistoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_id')
                    ->label('Vehicle')
                    ->relationship('vehicle', 'name')
                    ->required(),
                Select::make('place_id')
                    ->label('Place')
                    ->relationship('place', 'name')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('address')
                            ->required()
                            ->maxLength(255),
                    ]),
                TextInput::make('miles')
                    ->label('Miles')
                    ->numeric()
                    ->hiddenOn('edit'),
                Select::make('mile_id')
                    ->label('Miles')
                    ->relationship('mile', 'miles')
                    ->disabled()
                    ->hiddenOn('create'),
                Repeater::make('services')
                    ->columnSpan(2)
                    ->relationship()
                    ->schema([
                        Select::make('work_id')
                            ->relationship('work', 'name')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('cost')
                                    ->required()
                                    ->numeric()
                                    ->prefix('$'),
                            ]),
                    ]),
                TextInput::make('total')
                    ->label('Total Cost')
                    ->prefix('$')
                    ->required()
                    ->numeric(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
