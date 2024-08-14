<?php

namespace App\Filament\Resources\DossierResource\Pages;

use App\Enums\DeliveryState;
use App\Enums\FactureState;
use App\Enums\PaiementState;
use App\Filament\Resources\DossierResource;
use App\Models\Dossier;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewDossier extends ViewRecord
{
    protected static string $resource = DossierResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Dossier [ ' . $this->record->nom_dossier . ' ]')
                ->schema([
                    Group::make([
                        TextEntry::make('nom_dossier')
                        ->label('Nom du dossier'),

                        TextEntry::make('user.name')
                            ->label('Nom du client'),

                        Group::make([
                            TextEntry::make('livraison.statut_livraison')
                                ->badge()
                                ->color(DeliveryState::getColor())
                                ->default(DeliveryState::PENDING),
                            TextEntry::make('facture.montant')
                                ->money()
                                ->badge()
                                ->default(FactureState::NO->value)
                                ->label('Facturee')
//                              ->getColor(FactureState::getColor()),
                                ->color(FactureState::getColor()),
                            TextEntry::make('paiement.statut')
                                ->badge()
                                ->color(PaiementState::getColor())
                                ->default(PaiementState::NO),
                        ])
                    ])
                    ->columns(3)
                ]),
            ])
        ;
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make('edit')
            ->form(Dossier::getForm())
            ->modal()
        ];
    }

}
