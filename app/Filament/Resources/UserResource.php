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
use Filament\Tables\Columns;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function register(Request $request)
    {
        // Sauvegarde des données d'inscription dans la base de données

        // Rafraîchissement des données dans Filament
        UserResource::refresh();

        // Redirection ou traitement supplémentaire
    }


    public static function table(Table $table): Table
    {
        // Récupérer tous les utilisateurs inscrits
        $users = User::all();

        return $table
            ->columns([
                Columns\TextColumn::make(name:'name'),
                Columns\TextColumn::make(name:'premon'),
                Columns\TextColumn::make(name:'email'),
                Columns\TextColumn::make(name:'telephone'),
                Columns\TextColumn::make(name:'adresse')
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
