<?php

namespace App\Filament\Widgets;

use App\Models\Vehicle;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class VehicleMileageOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Mileage';

    protected function getStats(): array
    {
        $year = Carbon::now()->year;

        $latestMiles = DB::table('miles as m')
            ->select('m.vehicle_id', 'm.miles')
            ->leftJoin('miles as m1', function ($join) {
                $join->on('m.vehicle_id', '=', 'm1.vehicle_id')
                    ->whereRaw(DB::raw('m.created_at < m1.created_at'));
            })
            ->whereNull('m1.vehicle_id')
            ->pluck('miles', 'vehicle_id');

        $vehicles = Vehicle::where('status', 'A')->get();

        $stats = [];

        foreach ($vehicles as $vehicle) {
            $current = $latestMiles[$vehicle->id] ?? null;

            if ($current === null) {
                continue;
            }

            $baseline = $vehicle->miles()
                ->where('created_at', '<', Carbon::create($year, 1, 1)->startOfDay())
                ->orderByDesc('created_at')
                ->first();

            if (! $baseline) {
                $baseline = $vehicle->miles()
                    ->whereYear('created_at', $year)
                    ->orderBy('created_at')
                    ->first();
            }

            $driven = $baseline ? max(0, $current - $baseline->miles) : 0;

            $sparkline = $vehicle->miles()
                ->orderByDesc('created_at')
                ->limit(12)
                ->pluck('miles')
                ->reverse()
                ->values()
                ->toArray();

            $color = match (true) {
                $driven >= 15000 => 'danger',
                $driven >= 10000 => 'warning',
                default          => 'success',
            };

            $stats[] = Stat::make($vehicle->name, number_format($current))
                ->description(number_format($driven) . ' mi driven in ' . $year)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->descriptionColor($color)
                ->chart($sparkline)
                ->color($color);
        }

        return $stats;
    }
}
