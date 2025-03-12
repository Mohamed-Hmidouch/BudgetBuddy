<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Api\Tag;
use Illuminate\Auth\Access\Response;


class TagPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        // $hasPermission = $user->permissions()->where('title','Show-tag');
        // return $hasPermission?true:false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tag $tag): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tag $tag): bool
    {

        $hasPermission = $user->permissions()->where('title','update-tag')->first();
        if($user && $hasPermission){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tag $tag): bool
    {
        //
        $hasPermission = $user->permissions()->where('title','delete-tag')->first();
        if($user?->id === $tag->user_id && $hasPermission){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tag $tag): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tag $tag): bool
    {
        //
    }
}
