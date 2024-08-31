<?php

namespace App\Filament\Pages;

use App\Filament\Resources\DossierResource\Pages\CreateDossier;
use Filament\Actions\Action;
use Filament\Pages\Page;

class Home extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.home';

//    protected function getHeaderActions(): array
//    {
//        return [
//            Action::make('Creer un client')
//        ];
//    }
}
