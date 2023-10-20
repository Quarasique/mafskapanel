<?php

namespace App\Filament\Resources;


use App\Filament\Resources\MeetingResource\Configuration;
use App\Filament\Resources\MeetingResource\Pages\ManageMeetings;
use App\Models\Game\Meeting;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;


class MeetingResource extends Resource
{
    static ?string $model = Meeting::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema(
                Configuration::schema(),
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns(
                Configuration::columns()
            )
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageMeetings::route('/'),
        ];
    }
}
