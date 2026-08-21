<?php

namespace App\Enums;

enum ActivityType: string
{
    case DAYCARE_REQUEST_CREATED = 'daycare_request_created';

    case DAYCARE_REQUEST_ACCEPTED = 'daycare_request_accepted';

    case DAYCARE_REQUEST_REFUSED = 'daycare_request_refused';

}
