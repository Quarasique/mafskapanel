<?php

namespace App\Filament\Resources;

use App\Enums\Time;
use App\Filament\Resources\MeetingResource\Pages\ManageMeetings;
use App\Models\Game\Meeting;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;


class MeetingResource extends Resource
{
    static ?string $model = Meeting::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->minLength(4)
                    ->maxLength(64)
                    ->unique('meetings', 'name'),
                Select::make('time')
                    ->required()
                    ->options(Time::class)
                    ->searchable(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageMeetings::route('/'),
        ];
    }
}
