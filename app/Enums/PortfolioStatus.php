<?php

namespace App\Enums;

enum PortfolioStatus: string
{
    case DRAFT = 'DRAFT';
    case PENDING = 'PENDING';
    case PUBLISHED = 'PUBLISHED';
    case REJECTED = 'REJECTED';
}
