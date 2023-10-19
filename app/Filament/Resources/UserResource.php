<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
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
use Illuminate\Support\Facades\Hash;


class UserResource extends Resource
{
    static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->minLength(4)
                    ->maxLength(20)
                    ->unique('users', 'name'),
                TextInput::make('email')
                    ->required()
                    ->email(),
                TextInput::make('password')
                    ->required()
                    ->password()
                    ->minLength(8)
                    ->dehydrateStateUsing(
                        fn(string $state) => Hash::make($state)
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
            ])
            ->filters([
                Filter::make('user')
                    ->form([
                        TextInput::make('name'),
                        TextInput::make('email'),
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
                            )
                            ->when(
                                $data['email'],
                                fn(Builder $query, $email): Builder => $query->where(
                                    'email',
                                    'ilike',
                                    "%$email%",
                                )
                            );
                    })
                    ->label('name')
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['name'] ?? null) {
                            $indicators['name'] = 'Name contains: ' . $data['name'];
                        }

                        if ($data['email'] ?? null) {
                            $indicators['email'] = 'E-mail contains: ' . $data['email'];
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
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
