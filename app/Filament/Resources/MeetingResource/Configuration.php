<?php

namespace App\Filament\Resources\MeetingResource;

use App\Enums\Targets;
use App\Enums\Time;
use App\Filament\Resources\Configurable;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class Configuration implements Configurable
{
    public static function schema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->minLength(4)
                ->maxLength(64),
            Select::make('time')
                ->required()
                ->options(Time::class)
                ->searchable(),
            Select::make('targets')
                ->required()
                ->options(Targets::class)
                ->searchable()
                ->label('Possible targets'),
            Toggle::make('solo'),
        ];
    }

    public static function columns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('time'),
            ToggleColumn::make('solo'),
            TextColumn::make('targets')
                ->label('Possible targets'),
        ];
    }
}
