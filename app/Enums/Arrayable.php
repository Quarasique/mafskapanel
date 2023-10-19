<?php

namespace App\Enums;

trait Arrayable
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
