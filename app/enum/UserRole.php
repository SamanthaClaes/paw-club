<?php

namespace App\enum;

enum UserRole: string
{
    case OWNER = 'owner';
    case PETSITTER = 'petsitter';
    case ADMIN = 'admin';
}
