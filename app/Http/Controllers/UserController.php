<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
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
        if (Gate::check('user:index')) {
            return view('user.index', [
                'users' => User::all()
            ]);
        }
        return Response::noContent(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Application|Factory|\Illuminate\Http\Response|View
     */
    public function create(Request $request)
    {
        $ajax = $request->ajax();
        $fingerprint = $request->fingerprint();
        return json_encode($request);
        // TODO: persist new user
//        $this->authorize('create', auth()->user());
    }

    public function createForm()
    {
        if (Gate::allows('user:create', auth()->user())) {
            return view('user.create', [
                'data' => [
                    'url' => route('user.create.post'),
                    'method' => 'POST'
                ]
            ]);
        }
        return Response::noContent(404);
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
     * @param User $user
     * @return Application|Factory|\Illuminate\Http\Response|View
     */
    public function show(User $user)
    {
        if (Gate::allows('user:view', auth()->user())) return view('user.show');
        return Response::noContent(404);
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
     * @param User $user
     * @return Application|Factory|\Illuminate\Http\Response|View
     */
    public function update(User $user)
    {
        if (Gate::allows('user:update', auth()->user())) {
            return view('user.show', [
                'user' => User::find($user->id)
            ]);
        }
        return Response::noContent(404);
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
