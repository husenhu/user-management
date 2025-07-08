<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Access Control';

    public static function canAccess(): bool{
        if (! Auth::check()) {
            return false;
        }

        return Auth::user()->can('user.access');
    }

    public static function canView(Model $record): bool{
        return auth()->user()->can('user.view');
    }

    public static function canCreate(): bool{
        return auth()->user()->can('user.create');
    }

    public static function canEdit(Model $record): bool{
        return auth()->user()->can('user.edit');
    }

    public static function canDelete(Model $record): bool{
        return auth()->user()->can('user.delete');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->required()->email(),

                Forms\Components\Select::make('roles')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->relationship('roles', 'name')
                    ->label('Roles'),

                Forms\Components\Select::make('permissions')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->relationship('permissions', 'name')
                    ->label('Direct Permissions'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\BadgeColumn::make('roles.name')->label('Roles')->separator(', '),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
