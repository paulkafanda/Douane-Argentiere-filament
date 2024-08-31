<?php

namespace App\Filament\Resources\DossierResource\Pages;

use App\Enums\DeliveryState;
use App\Filament\Resources\DossierResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDossiers extends ListRecords
{
    protected static string $resource = DossierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->slideOver(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Tous' => Tab::make(),
            'Non Facturee' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->doesntHave('facture')),
        ];
    }
}
