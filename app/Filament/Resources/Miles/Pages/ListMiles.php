<?php

namespace App\Filament\Resources\Miles\Pages;

use App\Filament\Resources\Miles\MileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMiles extends ListRecords
{
    protected static string $resource = MileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
