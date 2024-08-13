<?php

namespace App\Filament\Resources;

use App\Enums\DocumentTypes;
use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function Pest\Laravel\options;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Dossiers & cfr';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Document::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom_document')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_expiration')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('piece_jointe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dossier.nom_dossier')
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
                Tables\Actions\EditAction::make()->slideOver(),
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
            'index' => Pages\ListDocuments::route('/'),
//            'create' => Pages\CreateDocument::route('/create'),
//            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
