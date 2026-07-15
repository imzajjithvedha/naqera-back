<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case HOST = 'host';
    case AGENT = 'agent';
    case ESTATE_HOST = 'estate-host';
    case CUSTOMER = 'customer';
}