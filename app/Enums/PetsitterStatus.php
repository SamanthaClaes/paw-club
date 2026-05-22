<?php

namespace App\Enums;

enum PetsitterStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REFUSED = 'refused';
}
