<?php

namespace App\Enums;

enum PetsitterRequestStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REFUSED = 'refused';
    case MODIFICATION_REQUESTED = 'modification_requested';
}
