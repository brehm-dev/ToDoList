<?php

namespace App\Http\Controllers;

use App\Procedure;
use App\Schedule;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ProcedureController extends Controller
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
     * @param Schedule $schedule
     * @return JsonResponse
     */
    public function index(Schedule $schedule)
    {
        $procedures = Procedure::where('schedule_id', $schedule->id)->orderBy('created_at', 'DESC')->get();
        foreach ($procedures as $procedure) {
            $procedure->creator = $procedure->getCreator();
        }
        return \response()->json($procedures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Schedule $schedule
     * @return Application|Factory|View
     */
    public function create(Request $request, Schedule $schedule)
    {
        return view('procedure.view', [
            'action' => route('procedure.create', ['schedule' => $schedule]),
            'schedule' => $schedule
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Schedule $schedule
     * @return RedirectResponse
     */
    public function store(Request $request, Schedule $schedule)
    {
        $newProcedureData = $request->all();

        $this->validate($request, [
            'content_type' => ['required', 'string'],
            'content' => ['required','string']
        ]);

        return Procedure::create([
            'schedule_id' => $schedule->getAttribute('id'),
            'content_type' => $newProcedureData['content_type'],
            'content' => $newProcedureData['content'],
            'state' => Procedure::STATE_ACTIVE,
            'creator_id' => auth()->user()->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Schedule $schedule
     * @param Procedure $procedure
     * @return JsonResponse
     */
    public function show(Schedule $schedule, Procedure $procedure)
    {
        return \response()->json(Procedure::where([
            'id', $procedure->id,
            'schedule_id' => $schedule->id
        ])->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Procedure $procedure
     * @return Response
     */
    public function edit(Procedure $procedure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Schedule $schedule
     * @param Procedure $procedure
     * @return JsonResponse
     */
    public function update(Request $request, Schedule $schedule, Procedure $procedure)
    {
        $data = $request->all();
        $update = [];

        if ($data['state'] !== $procedure->state) {
            $update['state'] = $data['state'];
            if ($data['state'] === Procedure::STATE_PAUSE) {
                $update['paused_at'] = now();
            } elseif ($data['state'] === Procedure::STATE_FINISH) {
                $update['finished_at'] = now();
            } elseif ($data['state'] === Procedure::STATE_ACTIVE) {
                $update['activated_at'] = now();
            }
        }
        $update['content'] = $data['content'];
        $procedure->update($update);
        return \response()->json(['updated' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Schedule $schedule
     * @param Procedure $procedure
     * @return false|Response|string
     * @throws Exception
     */
    public function destroy(Request $request, Schedule $schedule, Procedure $procedure)
    {
        try {
            return \response()->json(['deleted' => $procedure->delete()]);
        } catch (Exception $e) {
            // log $e
            return \response()->json(['deleted' => false]);
        }
    }
}
