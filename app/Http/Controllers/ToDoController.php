<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\ToDo;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $todos = new Collection();
        $schedules = Schedule::all()->where('visibility', auth()->user()->role);
        foreach ($schedules as $schedule) {
            $todos->add(ToDo::getForSchedule($schedule));
        }
        return view('todo.index', [
            'todos' => $todos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Schedule $schedule
     * @return Application|Factory|View|void
     */
    public function create(Request $request, Schedule $schedule)
    {
        return view('todo.view', [
            'schedule' => $schedule,
            'action' => route('create.todo', [$schedule])
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
        $params = $request->all();
        $todo = ToDo::create([
            'creator_user_id' => $params['creator'],
            'schedule_id' => $schedule->getAttribute('id'),
            'title' => $params['title'],
            'description' => $params['description']
        ]);
        return redirect()->route('read.todo', [$schedule, $todo]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Schedule $schedule
     * @param $todoId
     * @return Application|Factory|View
     */
    public function show(Request $request, Schedule $schedule, $todoId)
    {
        $todo = ToDo::where('id', $todoId)->get()->first();
        return view('todo.view', [
            'schedule' => $schedule,
            'todo' => $todo,
            'action' => route('update.todo', [$schedule, $todo])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ToDo $toDo
     * @return Response
     */
    public function edit(ToDo $toDo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ToDo $toDo
     * @return Response
     */
    public function update(Request $request, ToDo $toDo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ToDo $toDo
     * @return Response
     */
    public function destroy(ToDo $toDo)
    {
        //
    }
}
