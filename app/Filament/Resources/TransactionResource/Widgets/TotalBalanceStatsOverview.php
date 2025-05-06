<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalBalanceStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $income = Transaction::query()
            ->where('user_id', auth()->id())
            ->where('type', 'income')
            ->sum('amount');

        $expenses = Transaction::query()
            ->where('user_id', auth()->id())
            ->where('type', 'expense')
            ->sum('amount');

        $balance = round(($income - $expenses) / 100, 2);

        return [
            Stat::make('Saldo Total', '$' . number_format($balance, 2))
                //->icon('heroicon-o-cash')
                ->color($balance >= 0 ? 'success' : 'danger'),
            Stat::make('Ingresos Totales', '$' . number_format($income / 100, 2))
                ->color('success'),
            Stat::make('Gastos Totales', '$' . number_format($expenses / 100, 2))
                ->color('danger'),
        ];
    }
}
