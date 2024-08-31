<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DossierPolicy
{
    /**
     * Determine whether the user can view any models.
     */
//    public function viewAny(User $user): bool
//    {
//        return $user->role === UserRole::OPERATOR->value || $user->role === UserRole::FINANCING->value;
//    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Dossier $dossier): bool
    {
        return $user->isOperatorOrFinancing() || $user->id === $dossier->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->value === UserRole::OPERATOR->value;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Dossier $dossier): bool
    {
        return $user->role === UserRole::OPERATOR->value;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Dossier $dossier): bool
    {
        return $user->role === UserRole::OPERATOR->value;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Dossier $dossier): bool
    {
        return $user->role === UserRole::OPERATOR->value;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Dossier $dossier): bool
    {
        return $user->role === UserRole::OPERATOR->value;
    }
}
