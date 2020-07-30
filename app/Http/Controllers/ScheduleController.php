<?php

namespace App\Http\Controllers;

use App\Schedule;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
        return Schedule::where('id', $schedule->id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Schedule $schedule
     * @return JsonResponse
     */
    public function update(Request $request, Schedule $schedule)
    {
        $parameters = $request->all();
        $updated = $schedule->update([
            'name' => $parameters['name'],
            'type' => $parameters['type'],
        ]);
        return \response()->json(['updated' => $updated]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $schedule
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Schedule $schedule)
    {
        return \response()->json(['deleted' => $schedule->delete()]);
    }
}
