<?php


namespace Tests\Unit;


use App\Schedule;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    const USER = [
        'username' => 'testUsername',
        'email' => 'test@email.test',
        'role' => User::ROLE_USER,
        'password' => 'DasistEinPassword'
    ];

    public function testCreation()
    {
        $user = User::create(self::USER);
        $schedule = $this->getInstance($user);
        $this->assertInstanceOf(
            Schedule::class,
            $schedule,
            "$$schedule need to be instance of Schedule::class"
        );
    }

    public function testUpdating()
    {
        $user = User::create(self::USER);
        $schedule = $this->getInstance($user);
        $update = [];
        $update['type'] = $schedule->type === Schedule::TYPE_GLOBAL ? Schedule::TYPE_PRIVATE : Schedule::TYPE_GLOBAL;
        $result = $schedule->update($update);
        $this->assertTrue($result);
    }

    public function testDeleting()
    {
        $user = User::create(self::USER);
        $schedule = $this->getInstance($user);
        $this->assertTrue($schedule->delete());
    }

    private function getInstance(User $user)
    {
        return Schedule::create([
            'owner_id' => $user->id,
            'name' => $this->faker->monthName,
            'type' => Schedule::TYPE_GLOBAL,
        ]);
    }
}
