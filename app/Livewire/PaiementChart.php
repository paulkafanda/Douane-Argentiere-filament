<?php

namespace App\Livewire;

use App\Models\Paiement;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PaiementChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $data = Paiement::with('dossier.user') // Assuming you have a 'customer' relationship
        ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('y-d-m'); // Group by day
            })
            ->map(function ($items) {
                return [
                    'sum' => $items->sum('montant'),
                    'clients' => $items->pluck('dossier.user.name')->unique()->toArray(), // Collect unique customer names
                ];
            });

        return [
            'labels' => $data->keys(),
            'datasets' => [
                [
                    'label' => 'Paiements',
                    'data' => $data->map(fn ($value) => $value['sum']),
                    'tooltip' => $data->map(fn ($value) => implode(', ', $value['clients'])), // Tooltip text
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
