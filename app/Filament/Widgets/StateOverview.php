<?php

namespace App\Filament\Widgets;
use App\Models\Shop;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StateOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';

    protected static bool $islazy = true;

    protected function getStats(): array
    {
        return [
             Stat::make(label: 'Total Shops', value: Shop::count())
             ->description(description: 'The number of registered shops')
             ->descriptionIcon(icon: 'heroicon-m-arrow-trending-up')
             ->color('success')
             ->chart([7, 3, 4, 5, 6, 3, 2, 5]),

             Stat::make(label: 'Total Users', value: User::count())
             ->description(description: 'The number of registered users')
             ->descriptionIcon(icon: 'heroicon-m-arrow-trending-down')
             ->color('danger')
             ->chart([7, 3, 4, 5, 6, 3, 2, 5]),

             Stat::make(label: 'Total client', value: User::count())
             ->description(description: 'The number of registered users')
             ->descriptionIcon(icon: 'heroicon-m-arrow-trending-down')
             ->color('warning')
             ->chart([7, 3, 4, 5, 6, 3, 2, 5]),
        ];
    }
}
