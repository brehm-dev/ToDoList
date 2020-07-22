<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {

    }

    /**
     * Determine whether the user can view any models.
     *
     * @return boolean
     */
    public function viewAny()
    {
        return auth()->user()->roleIsUser();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param Request $request
     * @param $id
     * @return boolean
     */
    public function view(...$id)
    {
//        dd(id);
        return true;
//        return (bool) $user->id == $model->id || $user->roleIsAdmin();
//        if (Gate::allows('show-user', auth()->user())) {
//            $users = User::all();
//            return view('user.show', ['users' => $users]);
//        }
//        return Response::noContent(404);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
//        dd($user);
        return (bool) $user->roleIsUser();
//        dd($user->roleIsAdmin());
//        return $user->roleIsAdmin();
//        return is_int($user->getAuthIdentifier());
//        dd(Gate::check('user:create'));
//        if (Gate::allows('user:create', auth()->user())) {
//            $users = User::all();
//            dd($users);
//            return view('user.create', ['users' => $users]);
//        }
//        return Response::noContent(404);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return (bool) $user->id == $model->id || $user->roleIsAdmin();

//        if (Gate::allows('update-user', auth()->user())) {
//            $users = User::all();
//            return view('user.show', ['users' => $users]);
//        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return (bool) $user->id == $model->id || $user->roleIsAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }

    public function before(User $user, $ability)
    {

    }
}
