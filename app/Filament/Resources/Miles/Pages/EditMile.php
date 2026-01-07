<?php

namespace App\Filament\Resources\Miles\Pages;

use App\Filament\Resources\Miles\MileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMile extends EditRecord
{
    protected static string $resource = MileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
