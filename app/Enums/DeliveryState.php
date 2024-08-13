<?php

namespace App\Enums;

enum DeliveryState: string
{
    case PENDING = 'EN ATTENTE';
    case IN_PROGRESS = 'EN COURS';
    case TERMINATED = 'TERMINEE';

    public static function getColor(): \Closure
    {
        return function ($state) {
            return match ($state) {
                DeliveryState::PENDING => 'warning',
                DeliveryState::IN_PROGRESS => 'info',
                DeliveryState::TERMINATED => 'success',
                default => 'waring'
            };
        };
    }
}
