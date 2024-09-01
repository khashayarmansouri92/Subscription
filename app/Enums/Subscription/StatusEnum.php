<?php

namespace App\Enums\Subscription;

enum StatusEnum: string
{
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case PENDING = 'pending';
}
