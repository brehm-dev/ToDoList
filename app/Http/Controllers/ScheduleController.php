<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ScheduleController extends Controller
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
     * @return Collection
     */
    public function index()
    {
        return new Collection([
            'privates' => Schedule::getPrivateSchedules(),
            'ownGlobals' => Schedule::getOwnGlobalSchedules(),
            'foreignGlobals' => Schedule::getGlobalSchedules()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Schedule $schedule
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        //TODO: authorization and check user's role
        return view('schedule.view', [
            'action' => route('schedule.create')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        return Schedule::create([
            'owner_id' => auth()->user()->getAuthIdentifier(),
            'name' => $data['name'],
            'type' => $data['type']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Schedule $schedule
     * @return Application|Factory|View
     */
    public function show(Schedule $schedule)
    {
        return view('schedule.view', [
            'schedule' => $schedule,
            'action' => route('schedule.update', [$schedule]),
            'method' => 'PATCH'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Schedule $schedule
     * @return Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Schedule $schedule
     * @return RedirectResponse
     */
    public function update(Request $request, Schedule $schedule)
    {
        $parameters = $request->all();
//        dd($parameters);
        $isUpdated = $schedule->update([
            'name' => $parameters['name'],
            'type' => $parameters['type'],
            'info' => $parameters['info']
        ]);
        if ($isUpdated) {
            return redirect()->route('schedule.index');
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $schedule
     * @return bool|Response
     * @throws \Exception
     */
    public function destroy(Schedule $schedule)
    {
        return json_encode(['deleted' => $schedule->delete()]);
    }
}
