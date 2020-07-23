<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Http\Response|View
     */
    public function index()
    {
        // TODO: pagination
        return view('user.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Application|Factory|RedirectResponse|\Illuminate\Http\Response|View
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8'
            ],
        ]);

        $newUser = User::create($request->all());
        if ($request->ajax()) {
            return $newUser;
        }
        return redirect()->route('read.user', $newUser);
    }

    public function createForm()
    {
        return view('user.create', [
            'data' => [
                'url' => route('create.user'),
                'method' => 'POST'
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $id $user->id
     * @return Application|Factory|\Illuminate\Http\Response|View
     */
    public function view(Request $request, $id)
    {
        $user = User::find($id);
        Gate::check('user-view-user');
        return view('user.view', [
            'user' => $user,
            'action' => route('update.user', [$user]),
            'method' => 'PATCH'
        ]);
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
     * @param $userId
     * @return RedirectResponse
     */
    public function update(Request $request, $userId)
    {
        $data = $request->all();
        $user = User::find($userId);
        // TODO authorize user and validate data
        if ($user instanceof User) {
            User::where('id', $userId)->update([
                'username' => $data['username'],
                'email' => $data['email'],
                'role' => $data['role']
            ]);
        }
        return redirect()->route('index.user');
//        dd();
//        if (Gate::allows('user:update', auth()->user())) {
//            return view('user.show', [
//                'user' => User::find($user->id)
//            ]);
//        }
//        return Response::noContent(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Application|Factory|\Illuminate\Http\Response|View
     */
    public function destroy(User $user)
    {
        if (Gate::allows('user:delete', auth()->user())) {
            return view('user.show');
        }
        return Response::noContent(404);
    }
}
