<?php

namespace App\Filament\Resources\ServiceHistories\Pages;

use App\Filament\Resources\ServiceHistories\ServiceHistoryResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Mile;

class CreateServiceHistory extends CreateRecord
{
    protected static string $resource = ServiceHistoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (strlen($data['miles']))
        {
            $miles = new Mile();

            $miles->vehicle_id = $data['vehicle_id'];
            $miles->miles      = $data['miles'];
            $miles->save();

            $data['mile_id'] = $miles->id;
        }

        return $data;
    }
}
