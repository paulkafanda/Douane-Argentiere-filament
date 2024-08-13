<?php

namespace App\Filament\Resources;

use App\Enums\DeliveryState;
use App\Filament\Resources\DossierResource\Pages;
use App\Filament\Resources\DossierResource\RelationManagers;
use App\Models\Dossier;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DossierResource extends Resource
{
    protected static ?string $model = Dossier::class;
//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Dossiers & cfr';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Dossier::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom_dossier')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('facture.montant')
                    ->money()
                    ->icon(fn ($state) => match (is_numeric($state)) {
                        true => false,
                        default => 'heroicon-o-no-symbol'
                    })
                    ->default(false)
                    ->color(fn ($state) => match (is_numeric($state)) {
                        true => 'success',
                        default => 'danger',
                    }),
                Tables\Columns\IconColumn::make('facture.paiement.montant')
                    ->icon(fn ($state) => match (is_numeric($state)) {
                        true => 'heroicon-o-document-check',
                        default => 'heroicon-o-no-symbol'
                    })
                    ->color(fn ($state) => match (is_numeric($state)) {
                        true => 'success',
                        default => 'warning',
                    })
                    ->default('heroicon-o-no-symbol'),
                Tables\Columns\TextColumn::make('livraison.statut_livraison')
                    ->badge()
                    ->color(DeliveryState::getColor())
                    ->default(DeliveryState::PENDING)
                    ->label('Livraison'),
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
                Tables\Actions\ViewAction::make(),
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
            RelationManagers\MarchandisesRelationManager::class,
            RelationManagers\DocumentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDossiers::route('/'),
//            'create' => Pages\CreateDossier::route('/create'),
//            'edit' => Pages\EditDossier::route('/{record}/edit'),
            'view' => Pages\ViewDossier::route('/{record}'),
        ];
    }
}
