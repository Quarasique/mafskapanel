<?php

namespace App\Enums;

enum Time: string
{
    use Arrayable;

    case Day = 'day';
    case Night = 'night';
    case Morning = 'morning';
    case Evening = 'evening';
}
