<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailMarchandiseResource\Pages;
use App\Filament\Resources\DetailMarchandiseResource\RelationManagers;
use App\Models\DetailMarchandise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailMarchandiseResource extends Resource
{
    protected static ?string $model = DetailMarchandise::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Dossiers & cfr';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('qte')
                    ->required()
                    ->minValue(1)
                    ->numeric(),
                Forms\Components\Select::make('marchandise_id')
                    ->relationship('marchandise', 'designation')
                    ->required(),
                Forms\Components\TextInput::make('dossier_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('marchandise.designation')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qte')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListDetailMarchandises::route('/'),
//            'create' => Pages\CreateDetailMarchandise::route('/create'),
//            'edit' => Pages\EditDetailMarchandise::route('/{record}/edit'),
        ];
    }
}
