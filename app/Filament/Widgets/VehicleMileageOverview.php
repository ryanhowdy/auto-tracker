<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Mile;
use Illuminate\Support\Facades\DB;

class VehicleMileageOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Current Mileage';

    protected function getStats(): array
    {
        $milesPerCar = DB::table('miles as m')
            ->select('m.*', 'v.name')
            ->leftJoin('miles as m1', function ($join) {
                $join->on('m.vehicle_id', '=', 'm1.vehicle_id')
                    ->whereRaw(DB::raw('m.created_at < m1.created_at'));
            })
            ->leftJoin('vehicles as v', 'm.vehicle_id', '=', 'v.id')
            ->whereNull('m1.vehicle_id')
            ->get();

        $stats = [];

        foreach($milesPerCar as $car)
        {
            $stats[] = Stat::make($car->name, number_format($car->miles));
        }

        return $stats;
    }
}
