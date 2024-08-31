<?php

namespace App\Filament\Resources;

use App\Enums\UserRole;
use App\Filament\Resources\MarchandiseResource\Pages;
use App\Filament\Resources\MarchandiseResource\RelationManagers;
use App\Models\Marchandise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MarchandiseResource extends Resource
{
    protected static ?string $model = Marchandise::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Dossiers & cfr';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('designation')
                    ->required(),
                Forms\Components\TextInput::make('type_marchandise')
                    ->required(),
                Forms\Components\Select::make('dossier_id')
                    ->relationship('dossier', 'nom_dossier')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('designation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_marchandise')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dossier.nom_dossier')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('detail.qte')
                ->label('Qte'),
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
            'index' => Pages\ListMarchandises::route('/'),
//            'create' => Pages\CreateMarchandise::route('/create'),
//            'edit' => Pages\EditMarchandise::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        return match (auth()->user()->role) {
            UserRole::CLIENT => $query->whereRelation('dossier', 'user_id', auth()->id()),
            default => $query,
        };
    }
}
