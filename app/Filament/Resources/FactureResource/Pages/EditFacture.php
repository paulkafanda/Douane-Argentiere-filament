<?php

namespace App\Filament\Resources\FactureResource\Pages;

use App\Filament\Resources\FactureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFacture extends EditRecord
{
    protected static string $resource = FactureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
