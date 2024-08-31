<?php

namespace App\Enums;

enum UserRole: string
{
    case CLIENT = 'client';
    case FINANCING = 'financing';
    case OPERATOR = 'operator';
}
