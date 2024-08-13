<?php

namespace App\Enums;

enum FactureState: string
{
    case YES = 'OUI';
    case NO = 'NON';

    public static function getColor(): \Closure
    {
        return function ($state) {
            return match ($state) {
                self::YES => 'success',
                self::NO => 'danger',
            };
        };
    }
}
