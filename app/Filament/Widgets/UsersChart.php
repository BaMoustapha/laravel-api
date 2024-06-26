<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class UsersChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static ?int $sort = 3;


    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
