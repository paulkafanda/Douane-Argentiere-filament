<?php

namespace App\Filament\Resources;

use App\Enums\DeliveryState;
use App\Enums\UserRole;
use App\Filament\Resources\LivraisonResource\Pages;
use App\Filament\Resources\LivraisonResource\RelationManagers;
use App\Models\Livraison;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LivraisonResource extends Resource
{
    protected static ?string $model = Livraison::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('date_livraison')
                    ->required()
                ->default(now()->addWeeks(1)),
                Forms\Components\Select::make('statut_livraison')
                    ->options(DeliveryState::class)
                    ->default(DeliveryState::PENDING)
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
                Tables\Columns\TextColumn::make('dossier.nom_dossier')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_livraison')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statut_livraison')
                    ->badge()
                    ->color(DeliveryState::getColor())
                    ->searchable(),
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
            'index' => Pages\ListLivraisons::route('/'),
//            'create' => Pages\CreateLivraison::route('/create'),
//            'edit' => Pages\EditLivraison::route('/{record}/edit'),
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
