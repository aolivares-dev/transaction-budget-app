<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

    class SpendingByDayChart extends ChartWidget
{
    protected static ?string $heading = 'Gasto/Ingreso diario del mes';
    protected static ?string $maxHeight = '300px';
    protected static ?string $pollingInterval = null; // Evita refrescos automáticos
    protected static ?int $sort = 1; // Controla el orden del widget

    protected function getData(): array
    {
        $data = Transaction::query()
            ->where('user_id', auth()->id())
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->where('type', 'expense') // Filtra para mostrar solo gastos
            ->selectRaw('DATE(transaction_date) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date')
            ->map(function ($value) {
                return round($value / 100, 2); // Apply MoneyCast logic directly
            });

        return [
            'datasets' => [
                [
                    'label' => 'Variación diaria (USD)',
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

    protected function getColors(): array
    {
        return [
            'datasets' => [
                [
                    'backgroundColor' => '#4CAF50',
                    'borderColor' => '#388E3C',
                ],
            ],
        ];
    }
}