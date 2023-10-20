<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Time: string implements HasLabel
{
    case Day = 'day';
    case Night = 'night';
    case Morning = 'morning';
    case Evening = 'evening';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
