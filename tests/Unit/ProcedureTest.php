<?php

namespace Tests\Unit;

use App\Procedure;
use App\Schedule;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProcedureTest extends TestCase
{
    use RefreshDatabase;

    const PROCEDURE = [
        'content_type' => 'todo',
        'content' => 'Et aliquid eos repellendus et dolorum id iusto. Ullam voluptatum ullam quod atque.',
        'state' => 'active'
    ];

    const SCHEDULE = [
        'name' => 'TestSchedule',
        'type' => 'private',
    ];

    const USER = [
        'email' => 'todolist@test.user',
        'username' => 'ToDoListUnitTesterUser',
        'password' => 'H1Mxf8UyS2FhGk9PAb5%YI2OdEVGkVaQ',
        'role' => User::ROLE_USER
    ];

    public function testWholeLifeCycle()
    {
        /* user instance */
        $user = User::create(self::USER);
        $this->assertInstanceOf(User::class, $user);

        /* check users id for schedule instantiation */
        $this->assertTrue(isset($user->id));
        $scheduleData = self::SCHEDULE;
        $scheduleData['owner_id'] = $user->id;

        /* schedule instance */
        $schedule = Schedule::create($scheduleData);
        $this->assertInstanceOf(Schedule::class, $schedule);

        /* prepare for instantiation of procedure */
        $procedureData = self::PROCEDURE;
        $this->assertTrue(isset($schedule->id));
        $procedureData['schedule_id'] = $schedule->id;

        /* procedure instance */
        $procedure = Procedure::create($procedureData);
        $this->assertInstanceOf(Procedure::class, $procedure);

        /* change the state of procedure from active to pause */
        $this->assertEquals('active', $procedure->state);
        $procedure->setPaused();
        $this->assertEquals('pause', $procedure->state);

        /* change state from pause to finish*/
        $procedure->setFinished();
        $this->assertEquals('finish', $procedure->state);

        /*
         * delete schedule for referential action on procedure
         * foreign_key is onDelete('cascade')
         */
        $schedule->delete();

        $this->assertTrue(Procedure::where('id', $procedure->id)->get()->isEmpty());
    }
}
