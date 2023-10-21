<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Targets: string implements HasLabel
{
    case All = 'all';
    case Village = 'village';
    case Mafia = 'mafia';
    case ThirdParty = 'third_party';
    case NonVillage = 'non_village';
    case NonMafia = 'non_mafia';
    case NonThirdParty = 'non_third_party';
    case Self = 'self';
    case NonSelf = 'non_self';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ThirdParty => 'Third party',
            self::NonVillage => 'Non village',
            self::NonMafia => 'Non mafia',
            self::NonThirdParty => 'NonThirdParty',
            self::NonSelf => 'Non self',
            default => $this->name,
        };
    }
}
