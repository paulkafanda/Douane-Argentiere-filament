<?php

namespace App\Models;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dossier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_dossier',
        'client_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'client_id' => 'integer',
    ];

    public static function getForm(): array
    {
        return [
            Group::make([
                TextInput::make('nom_dossier')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                ->searchable(),
            ])->columnSpanFull(),
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function marchandises(): HasMany
    {
        return $this->hasMany(Marchandise::class);
    }

    public function facture(): HasOne
    {
        return $this->hasOne(Facture::class);
    }

    public function livraison(): HasOne
    {
        return $this->hasOne(Livraison::class);
    }

    public function paiement(): HasOne
    {
        return $this->hasOne(Paiement::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
