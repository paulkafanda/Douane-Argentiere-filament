<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;

enum PaiementState: string
{
    case YES = 'OUI';
    case NO = 'NON';

    public static function getColor(): \Closure
    {
        return function ($state) {
            return match ($state) {
                self::YES => 'success',
                default => 'waring',
            };
        };
    }

}
