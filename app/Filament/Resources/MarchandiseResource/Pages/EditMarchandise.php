<?php

namespace App\Filament\Resources\MarchandiseResource\Pages;

use App\Filament\Resources\MarchandiseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarchandise extends EditRecord
{
    protected static string $resource = MarchandiseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
