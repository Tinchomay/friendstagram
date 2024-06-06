<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        //Aqui se pasa el usuario que esta autenticado y el post se pasara en el parametro cuando se mande a llamar este policy
        return $user->id === $post->user_id;
    }

}
