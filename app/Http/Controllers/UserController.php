<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return User[]|Application|Factory|Collection|Response|View
     */
    public function index(Request $request)
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return bool|RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ]
        ]);
        $data = $request->all();
        $newUser = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);
        return !is_bool($newUser) ? $newUser : false;
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function view(Request $request, User $user)
    {
        return User::find($user->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return User|RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $dataToUpdate = [];
        if ($user->username !== $data['username']) $dataToUpdate['username'] = $data['username'];
        if ($user->email !== $data['email']) $dataToUpdate['email'] = $data['email'];
        if ($user->role !== $data['role']) $dataToUpdate['role'] = $data['role'];

        $user->update($dataToUpdate);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param User $user
     * @return bool
     * @throws Exception
     */
    public function destroy(Request $request, User $user)
    {
        return json_encode(['deleted' => $user->delete()]);
    }
}
