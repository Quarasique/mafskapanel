<?php

namespace App\Filament\Resources;

interface Configurable
{
    public static function schema(): array;

    public static function columns(): array;
}
