<?php

namespace App\Enums;

enum PaiementState: string
{
    case YES = 'OUI';
    case NO = 'NON';
    case APPROVED = 'APPROUVEE';
}
