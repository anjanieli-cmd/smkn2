<?php

namespace App\Enums;

enum ChatbotResponseType: string
{
    case ANSWER = 'ANSWER';
    case OUT_OF_SCOPE = 'OUT_OF_SCOPE';
    case NOT_FOUND = 'NOT_FOUND';
    case REDIRECT_ADMIN = 'REDIRECT_ADMIN';
    case BLOCKED = 'BLOCKED';
}
