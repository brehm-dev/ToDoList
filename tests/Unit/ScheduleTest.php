<?php


namespace Tests\Unit;


use App\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testCreation()
    {
        $schedule = $this->getInstance();
        $this->assertInstanceOf(
            Schedule::class,
            $schedule,
            "$$schedule need to be instance of Schedule::class"
        );
    }

    public function testUpdating()
    {
        $old = $this->getInstance();

        $update = $this->getInstance();
        sleep(2);
        $new = $old->update([
            'name' => $update->name,
            'slug' => $this->faker->unique()->word(),
            'visibility' => $update->visibility,
            'description' => $update->description
        ]);
        $this->assertTrue($new);
    }

    public function testDeleting()
    {
        $schedule = $this->getInstance();
        $this->assertTrue($schedule->delete());
    }

    private function getInstance()
    {
        return Schedule::create([
            'name' => $this->faker->word(),
            'slug' => $this->faker->unique()->word(),
            'visibility' => $this->faker->uuid,
            'description' => $this->faker->realText(255)
        ]);
    }
}
