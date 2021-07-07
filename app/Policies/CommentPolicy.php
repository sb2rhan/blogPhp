<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasVerifiedEmail();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment)
    {
        $exists = $user
            ->posts()
            ->where('id', $comment->post_id)
            ->exists();

        if ($exists)
            return true;

        if (!$comment->user)
            return false;

        return $user->id == $comment->user->id;
    }
}
