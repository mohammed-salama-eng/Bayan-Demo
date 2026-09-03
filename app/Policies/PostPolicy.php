<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class PostPolicy
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
    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Permission::where('name', 'create posts')->exists()
            && $user->hasPermissionTo('create posts');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->hasRole('admin')
            || (Permission::where('name', 'edit posts')->exists()
                && $user->hasPermissionTo('edit posts')
                && $user->id === $post->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->hasRole('admin')
            || (Permission::where('name', 'delete posts')->exists()
                && $user->hasPermissionTo('delete posts')
                && $user->id === $post->user_id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->hasRole('admin');
    }
}
