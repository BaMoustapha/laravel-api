<?php

namespace App\Filament\Widgets;

use App\Models\Shop;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class ShopsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static ?int $sort = 3;


    protected function getData(): array
    {

        $data = $this->getShopPersMonth();


        return [
            'datasets'  => [
                [
                    'label' => 'Shop Count',
                    'data' => $data['shopPerMonth'],
                ]
            ],

            'labels' => $data['months']
        ];
    }

    protected function getType(): string
    {
        return 'line';
    } 

    private function getShopPersMonth(): array

    {
        $now  = Carbon::now();
        $shopsPerMonth  = [];
        $months = collect(range(start: 1, end: 12))->map(function($months) use ($now, $shopsPerMonth){
            $count = Shop::whereMonth('created_at', Carbon::parse($now->months($months)->format
            (format:  "Y-m")))->count();

            $shopsPerMonth[] = $count;

            return  $now->months($months)->format(format:"M");
        })->toArray();

            return [
                'shopPerMonth'=>$shopsPerMonth,
                'months'=>$months
            ];
    }
}
