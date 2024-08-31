<?php

namespace App\Livewire;

use App\Models\Paiement;
use Filament\Widgets\ChartWidget;

class PaiementChart extends ChartWidget
{
    protected static ?string $heading = 'Paiements';
    protected int | string | array $columnSpan = 1;
    public ?string $filter = '3months';

    public static function canView(): bool
    {
        return auth()->user()->isOperatorOrFinancing();
    }

    protected function getFilters(): ?array
    {
        return [
            'week' => 'Semaine Derniere',
            'month' => 'Mois dernier',
            '3months' => '3 dernier mois',
            'year' => 'Annee derniere'
        ];
    }

    protected function getData(): array
    {

        $data = match ($this->filter) {
            'week' => Paiement::with('dossier.user') // Assuming you have a 'customer' relationship
            ->whereBetween('created_at', [
                    now()->subWeek(), now()
                ]
            ),
            'month' => Paiement::with('dossier.user') // Assuming you have a 'customer' relationship
            ->whereBetween('created_at', [
                    now()->subMonth(), now()
                ]
            ),
            '3months' => Paiement::with('dossier.user') // Assuming you have a 'customer' relationship
            ->whereBetween('created_at', [
                    now()->subMonths(3), now()
                ]
            ),
            'year' => Paiement::with('dossier.user') // Assuming you have a 'customer' relationship
            ->whereBetween('created_at', [
                    now()->subYear(), now()
                ]
            )
        };

        $data = $data
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('y-d-m'); // Group by day
            })
            ->map(function ($items) {
                return [
                    'sum' => $items->sum('montant')
                ];
            });

        return [
            'labels' => $data->keys(),
            'datasets' => [
                [
                    'label' => 'Paiements',
                    'data' => $data->map(fn ($value) => $value['sum']),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
