<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return boolean
     */
    public function viewAny(User $user)
    {
        return $user->isRoleAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @return boolean
     */
    public function view(User $user)
    {
        return $user->isRoleAdmin();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isRoleAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->isRoleAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->isRoleAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->isRoleAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }

    public function before(User $user, $ability)
    {

    }
}
