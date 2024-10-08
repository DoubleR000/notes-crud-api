<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotePolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Note $note): Response
    {
        return $user->id === $note->user_id
            ? Response::allow()
            : Response::deny("You are not authorized for this action.");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Note $note): Response
    {
        return $user->id === $note->user_id
            ? Response::allow()
            : Response::deny("You are not authorized for this action.");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Note $note): Response
    {
        return $user->id === $note->user_id
            ? Response::allow()
            : Response::deny("You are not authorized for this action.");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Note $note): Response
    {
        return $user->id === $note->user_id
            ? Response::allow()
            : Response::deny("You are not authorized for this action.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Note $note): bool
    {
        return false;
    }
}
