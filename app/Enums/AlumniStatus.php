<?php

namespace App\Enums;

enum AlumniStatus: string
{
    case STUDYING = 'STUDYING';
    case WORKING = 'WORKING';
    case ENTREPRENEUR = 'ENTREPRENEUR';
    case OTHER = 'OTHER';
}
