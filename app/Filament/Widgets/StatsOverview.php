<?php

namespace App\Filament\Widgets;

use App\Models\Enquiry;
use App\Models\User;
use App\Models\Vehicle;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalVehicles   = Vehicle::count();
        $activeVehicles  = Vehicle::where('status', 'active')->count();
        $pendingVehicles = Vehicle::where('status', 'pending_review')->count();
        $totalUsers      = User::where('role', '!=', 'admin')->where('role', '!=', 'super_admin')->count();
        $enquiriesToday  = Enquiry::whereDate('created_at', today())->count();
        $totalEnquiries  = Enquiry::count();

        return [
            Stat::make('Total Listings', number_format($totalVehicles))
                ->description($activeVehicles . ' active · ' . $pendingVehicles . ' pending review')
                ->color($pendingVehicles > 0 ? 'warning' : 'success'),

            Stat::make('Pending Review', $pendingVehicles)
                ->description($pendingVehicles > 0 ? 'Needs approval action' : 'All clear!')
                ->color($pendingVehicles > 0 ? 'warning' : 'success'),

            Stat::make('Active Listings', number_format($activeVehicles))
                ->description('Live on marketplace')
                ->color('success'),

            Stat::make('Registered Sellers', number_format($totalUsers))
                ->description('Buyers & sellers')
                ->color('info'),

            Stat::make('Enquiries Today', $enquiriesToday)
                ->description('Buyer enquiries received today')
                ->color('primary'),

            Stat::make('Total Enquiries', number_format($totalEnquiries))
                ->description('All time')
                ->color('gray'),
        ];
    }
}
