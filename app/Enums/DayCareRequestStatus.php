<?php

namespace App\Enums;

enum DayCareRequestStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REFUSED = 'refused';
}
