<?php

namespace App\Models;

use App\Enums\DocumentTypes;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_document',
        'date_document',
        'date_expiration',
        'observation',
        'piece_jointe',
        'dossier_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_document' => 'timestamp',
        'date_expiration' => 'timestamp',
        'dossier_id' => 'integer',
    ];

    public static function getForm(): array
    {
        return [
            Select::make('nom_document')
            ->options(DocumentTypes::class)
            ->required(),
            Select::make('dossier_id')
                ->relationship('dossier', 'nom_dossier')
                ->required(),
            DateTimePicker::make('date_document')
                ->default(now())
            ->required(),
            DateTimePicker::make('date_expiration')
                ->default(now())
            ->required(),
            TextArea::make('observation')
            ->required(),
            FileUpload::make('piece_jointe')
            ->acceptedFileTypes(['application/pdf'])
            ->required(),
        ];
    }

    public static function getTableColumns(): array
    {
        return [
            TextColumn::make('nom_document')
                ->searchable(),
            TextColumn::make('date_document')
                ->dateTime()
                ->sortable()
            ->label('Date'),
            TextColumn::make('date_expiration')
                ->dateTime()
                ->sortable(),
            TextColumn::make('piece_jointe')
                ->searchable(),
            TextColumn::make('dossier.nom_dossier')
                ->numeric()
                ->sortable(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    public function dossier(): BelongsTo
    {
        return $this->belongsTo(Dossier::class);
    }
}
