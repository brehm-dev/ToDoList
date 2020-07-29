<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
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
     * @return User[]|Application|Factory|Collection|\Illuminate\Http\Response|View
     */
    public function index(Request $request)
    {
        $users = User::all();
        if ($request->isXmlHttpRequest()) {
            return $users;
        } else {
            return view('user.index', [
                'users' => $users
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
//        return view('user.view', [
//            'action' => route('user.create')
//        ]);
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
     * @param $id $user->id
     * @return void
     */
    public function view(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function edit(User $user)
    {

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
        if ($request->isXmlHttpRequest()) {
            return $user;
        } else {
            return redirect()->route('user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->isXmlHttpRequest()) {
            return json_encode(['deleted' => $user->delete()]);
        }
    }
}
