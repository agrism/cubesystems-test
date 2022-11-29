<?php

namespace App\Enums;

enum MessageType: string
{
    case SUCCESS = 'success';
    case ALERT = 'alert';
    case NO = '';
}
