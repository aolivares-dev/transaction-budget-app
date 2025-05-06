<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ExpenseByCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Gastos por Categoría';
    protected static ?string $chartSubHeading = 'Gastos por Categoría (USD)';
    protected static ?string $chartType = 'bar';
    protected static ?int $sort = 10;

    protected function getData(): array
    {
        $transactions = Transaction::query()
            ->where('user_id', auth()->id())
            ->where('type', 'expense')
            ->whereMonth('transaction_date', now()->month)
            ->select('category_id', DB::raw('SUM(amount) as total_gastado'))
            ->groupBy('category_id')
            ->with('category')
            ->get()
            ->map(function ($item) {
                return [
                    'categoria' => $item->category->name,
                    'total' => round($item->total_gastado / 100, 2),
                ];
            })
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => static::$chartSubHeading,
                    'data' => array_column($transactions, 'total'),
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                    ],
                    'borderColor' => [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => array_column($transactions, 'categoria'),
            ];
    }

    protected function getType(): string
    {
        return static::$chartType;
    }
}
