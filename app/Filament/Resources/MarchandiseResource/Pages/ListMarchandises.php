<?php

namespace App\Filament\Resources\MarchandiseResource\Pages;

use App\Filament\Resources\MarchandiseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMarchandises extends ListRecords
{
    protected static string $resource = MarchandiseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
