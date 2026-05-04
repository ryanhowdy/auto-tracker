<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\ServiceHistory;
use Carbon\Carbon;

class VehicleYearCostOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Yearly Costs';

    protected function getStats(): array
    {
        $costsByCar = ServiceHistory::whereYear('created_at', '>=', Carbon::now()->year)
            ->with('vehicle')
            ->get()
            ->groupBy('vehicle_id');

        $stats = [];

        foreach ($costsByCar as $carId => $costs) {
            $carName = $costs[0]->vehicle->name;
            $total   = $costs->sum('total');
            $stats[] = Stat::make($carName, '$' . number_format($total));
        }

        return $stats;
    }
}
