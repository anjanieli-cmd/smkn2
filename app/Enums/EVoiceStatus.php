<?php

namespace App\Enums;

enum EVoiceStatus: string
{
    case SUBMITTED = 'SUBMITTED';
    case REVIEWING = 'REVIEWING';
    case IN_PROGRESS = 'IN_PROGRESS';
    case RESOLVED = 'RESOLVED';
}
