<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('schedule.index', [
           'schedules' => Schedule::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        //TODO: authorization and check user's role
        return view('schedule.view', [
            'action' => route('create.schedule')
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

        // TODO: authorize user and validate new schedule
        $newScheduleData = $request->all();
//        dd();
        $schedule = Schedule::create([
            'name' => $newScheduleData['name'],
            'visibility' => $newScheduleData['visibility'],
            'description' => $newScheduleData['description']
        ]);
        return redirect()->route('read.schedule', [$schedule]);

    }

    /**
     * Display the specified resource.
     *
     * @param Schedule $schedule
     * @return Response
     */
    public function show(Schedule $schedule)
    {
//        dd($schedule->getAttributes());
        return view('schedule.view', [
            'schedule' => $schedule,
            'action' => route('update.schedule', [$schedule]),
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
        $isUpdated = $schedule->update([
            'name' => $parameters['name'],
            'visibility' => $parameters['visibility'],
            'description' => $parameters['description']
        ]);
        if ($isUpdated) {
            return redirect()->route('index.schedules');
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $schedule
     * @return Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
