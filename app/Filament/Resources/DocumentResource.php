<?php

namespace App\Filament\Resources;

use App\Enums\DocumentTypes;
use App\Enums\UserRole;
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
            ->columns(Document::getTableColumns())
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
            ])
            ->recordUrl(fn (Document $record) => '/storage/'.$record->piece_jointe)->openRecordUrlInNewTab();
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

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        return match (auth()->user()->role) {
            UserRole::CLIENT => $query->whereRelation('dossier', 'user_id', auth()->id()),
            default => $query,
        };
    }
}
