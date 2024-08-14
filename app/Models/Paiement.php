<?php

namespace App\Models;

use App\Enums\PaiementState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'num_transaction',
        'montant',
        'date_paiement',
        'preuve_paiement',
        'dossier_id',
        'facture_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
//        'montant' => 'decimal',
        'date_paiement' => 'timestamp',
        'dossier_id' => 'integer',
        'facture_id' => 'integer',
        'statut' => PaiementState::class,
    ];

    public function dossier(): BelongsTo
    {
        return $this->belongsTo(Dossier::class);
    }

    public function approve()
    {
        if ($this->statut === PaiementState::YES) {
            $this->statut = PaiementState::NO;
        } else {
            $this->statut = PaiementState::YES;
        }
        $this->save();
    }
}
