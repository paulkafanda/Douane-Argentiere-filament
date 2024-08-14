<?php

namespace App\Policies;

use App\Models\Facture;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FacturePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Facture $facture): bool
    {
        return $user->isOperatorOrFinancing();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isFinancing();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Facture $facture): bool
    {
        return $user->isFinancing();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Facture $facture): bool
    {
        return $user->isFinancing();
    }

    /**
     * Determine whether the user can restore the model.
     */
//    public function restore(User $user, Facture $facture): bool
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can permanently delete the model.
//     */
//    public function forceDelete(User $user, Facture $facture): bool
//    {
//        //
//    }
}
