<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopResource\Pages;
use App\Filament\Resources\ShopResource\RelationManagers;
use App\Models\Shop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShopResource extends Resource
{
    protected static ?string $model = Shop::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Group::make()
                    
                    ->schema([ // Utilisation de Group pour créer une section
                        Forms\Components\TextInput::make('name'),
                        Forms\Components\TextInput::make('logo'),
                        Forms\Components\TextInput::make('telephone')
                        
                        ->columnSpan( span : 'full')
                        ])->columns(2),
                    ]),
                    Forms\Components\Group::make()
                    
                    ->schema([ // Utilisation de Group pour créer une section
                        Forms\Components\TextInput::make('email'),
                        Forms\Components\TextInput::make('adresse'),
                        Forms\Components\MarkdownEditor::make('description')
                        

                            ->columnSpan( span : 'full')
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {

        $shops = Shop::all();


        return $table
            ->columns([
                Columns\ImageColumn::make(name:'Image'),
                Columns\TextColumn::make(name:'name'),
                Columns\TextColumn::make(name:'description'),
                Columns\TextColumn::make(name:'email'),
                Columns\TextColumn::make(name:'telephone')
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
            'index' => Pages\ListShops::route('/'),
            'create' => Pages\CreateShop::route('/create'),
            'edit' => Pages\EditShop::route('/{record}/edit'),
        ];
    }
}
