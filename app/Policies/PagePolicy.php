<?php

namespace App\Policies;

use App\Model\Page;
use App\Models\User;

class PagePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isPermission('edit-blog-posts');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Page $page): bool
    {
        return $user->isPermission('edit-blog-posts');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isPermission('create-blog-posts');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Page $page): bool
    {
        return $user->isPermission('edit-blog-posts');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Page $page): bool
    {
        return $user->isPermission('delete-blog-posts');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Page $page): bool
    {
        return $user->isPermission('edit-blog-posts');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Page $page): bool
    {
        return $user->isPermission('delete-blog-posts');
    }
}
