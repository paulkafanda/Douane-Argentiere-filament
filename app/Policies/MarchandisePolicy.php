<?php

namespace App\Policies;

use App\Models\Marchandise;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MarchandisePolicy
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
    public function view(User $user, Marchandise $marchandise): bool
    {
        return $user->isOperatorOrFinancing() || $user->id === $marchandise->dossier->user->id;
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
    public function update(User $user, Marchandise $marchandise): bool
    {
        return $user->isOperator();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Marchandise $marchandise): bool
    {
        return $user->isOperator();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Marchandise $marchandise): bool
    {
        return $user->isOperator();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Marchandise $marchandise): bool
    {
        return $user->isOperator();
    }
}
