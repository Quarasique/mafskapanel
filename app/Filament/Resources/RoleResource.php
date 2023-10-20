<?php

namespace App\Filament\Resources;

use App\Enums\Alignment;
use App\Filament\Resources\RoleResource\Pages\EditRole;
use App\Filament\Resources\RoleResource\Pages\ManageRoles;
use App\Filament\Resources\RoleResource\RelationManagers\MeetingsRelationManager;
use App\Models\Game\Role;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RoleResource extends Resource
{
    static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->minLength(3)
                    ->maxLength(64)
                    ->unique('meetings', 'name'),
                Select::make('alignment')
                    ->required()
                    ->options(Alignment::class)
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->color(
                        fn(TextColumn $column) => $column->getRecord()->alignment->getColor()
                    ),
            ])
            ->filters([
                Filter::make('user')
                    ->form([
                        TextInput::make('name'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['name'],
                                fn(Builder $query, $name): Builder => $query->where(
                                    'name',
                                    'ilike',
                                    "%$name%",
                                ),
                            );
                    })
                    ->label('name')
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['name'] ?? null) {
                            $indicators['name'] = 'Name contains: ' . $data['name'];
                        }

                        return $indicators;
                    })
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageRoles::route('/'),
            'edit' => EditRole::route('/{record}/edit')
        ];
    }

    public static function getRelations(): array
    {
        return [
            MeetingsRelationManager::class,
        ];
    }
}
