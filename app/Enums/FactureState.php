<?php

namespace App\Enums;

enum FactureState: string
{
    case YES = 'OUI';
    case NO = 'NON';

    public static function getColor(): \Closure
    {
        return function ($state) {
            return match (is_numeric($state)) {
                true => 'primary',
                default => 'danger',
            };
        };
    }
}
