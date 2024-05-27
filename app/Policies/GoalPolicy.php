<?php
namespace App\Policies;

use App\Models\Goal;
use App\Models\User;

class GoalPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // For now, allow all authenticated users to view any goals.
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Goal $goal): bool
    {
        // Allow the owner of the goal to view it.
        return $user->id === $goal->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Allow all authenticated users to create goals.
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Goal $goal): bool
    {
        // Allow the owner of the goal to update it.
        return $user->id === $goal->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Goal $goal): bool
    {
        // Allow the owner of the goal to delete it.
        return $user->id === $goal->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Goal $goal): bool
    {
        // Allow the owner of the goal to restore it.
        return $user->id === $goal->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Goal $goal): bool
    {
        // Allow the owner of the goal to permanently delete it.
        return $user->id === $goal->user_id;
    }
}
