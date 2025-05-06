<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class SpendingByDayChart extends ChartWidget
{
    protected static ?string $heading = 'Gasto Diario';
    protected static ?string $chartSubHeading = 'Variación diaria (USD)';
    protected static ?string $maxHeight = '300px';
    protected static ?string $pollingInterval = null;
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $data = Transaction::query()
            ->where('user_id', auth()->id())
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->where('type', 'expense')
            ->selectRaw('DATE(transaction_date) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date')
            ->map(function ($value) {
                return round($value / 100, 2);
            });

        return [
            'datasets' => [
                [
                    'label' => static::$chartSubHeading,
                    'data' => $data->values(),
                    'fill' => 'start',
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}