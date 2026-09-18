<?php

namespace App\Enums;

enum FactCheckStatus: string
{
    case VERIFIED = 'VERIFIED';
    case FALSE = 'FALSE';
    case UNCONFIRMED = 'UNCONFIRMED';
}
