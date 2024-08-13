<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PaiementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
//    public function viewAny(User $user): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Paiement $paiement): bool
    {
        return $user->isOperatorOrFinancing() || $user->id === $paiement->facture->dossier->user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === UserRole::CLIENT;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Paiement $paiement): bool
    {
        return $user->role === UserRole::CLIENT && $user->id === $paiement->facture->dossier->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Paiement $paiement): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Paiement $paiement): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Paiement $paiement): bool
    {
        return false;
    }
}
