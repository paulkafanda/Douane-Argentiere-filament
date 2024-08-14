<?php

namespace App\Policies;

use App\Models\DetailMarchandise;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DetailMarchandisePolicy
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
    public function view(User $user, DetailMarchandise $detailMarchandise): bool
    {
        return $user->isOperatorOrFinancing() || $user->id === $detailMarchandise->marchandise->dossier->user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isOperator();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DetailMarchandise $detailMarchandise): bool
    {
        return $user->isOperator();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DetailMarchandise $detailMarchandise): bool
    {
        return $user->isOperator();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DetailMarchandise $detailMarchandise): bool
    {
        return $user->isOperator();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DetailMarchandise $detailMarchandise): bool
    {
        return $user->isOperator();
    }
}
