<?php

namespace App\Filament\Resources;

use App\Enums\PaiementState;
use App\Enums\UserRole;
use App\Filament\Resources\PaiementResource\Pages;
use App\Filament\Resources\PaiementResource\RelationManagers;
use App\Models\Paiement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Number;

class PaiementResource extends Resource
{
    protected static ?string $model = Paiement::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'finances';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('num_transaction')
                    ->required()
                    ->default(strtoupper(auth()->user()->name) . '-' . str_pad(Paiement::whereRelation('dossier', 'user_id',auth()->user())->count() + 1, 5, '0', STR_PAD_LEFT )),
                Forms\Components\TextInput::make('montant')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('date_paiement')
                    ->default(now())
                    ->required(),
                Forms\Components\Select::make('dossier_id')
                    ->relationship('dossier', 'nom_dossier',
                        function (Builder $query) {
                            return $query->where('user_id', auth()->id())
                                ->whereHas('facture');
                        }
                    )
                    ->required(),
                Forms\Components\FileUpload::make('preuve_paiement')
                    ->columnSpanFull()
                    ->required()
                ->acceptedFileTypes(['application/pdf']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('num_transaction')
                    ->searchable(),
                Tables\Columns\TextColumn::make('montant')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('preuve_paiement')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dossier.facture.montant')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statut')
                    ->badge()
                ->label('Aprouvee'),
                Tables\Columns\TextColumn::make('date_paiement')
                    ->dateTime()
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('check')
                        ->visible(function(Paiement $record) {
                            return Gate::allows('approve', $record);
                        })
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                    ->action(fn($record) => $record->approve()),
                    Tables\Actions\EditAction::make()
                    ->color('primary'),
                ])
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
            'index' => Pages\ListPaiements::route('/'),
//            'create' => Pages\CreatePaiement::route('/create'),
//            'edit' => Pages\EditPaiement::route('/{record}/edit'),
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
