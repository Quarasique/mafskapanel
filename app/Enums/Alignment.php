<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Alignment: string implements HasLabel, HasColor
{
    case Village = 'village';
    case Mafia = 'mafia';
    case ThirdParty = 'third_party';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ThirdParty => 'Third party',
            default => $this->name,
        };
    }

    public function getColor(): string|array|null
    {
        return $this->name;
    }
}
