<?php

namespace App\Filament\Resources\DetailMarchandiseResource\Pages;

use App\Filament\Resources\DetailMarchandiseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailMarchandises extends ListRecords
{
    protected static string $resource = DetailMarchandiseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
