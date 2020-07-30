<?php

namespace Tests\Unit;

use App\Schedule;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testCreation()
    {
        $instance = factory(User::class)->create([User::TABLE_ROLE => User::ROLE_USER]);
        $this->assertTrue($instance->wasRecentlyCreated);
    }

    public function testUpdate()
    {
        $this->refreshDatabase();
        Artisan::call('db:seed');
        $attributes = [
            User::TABLE_USERNAME => $this->faker->userName,
            User::TABLE_EMAIL => $this->faker->safeEmail,
            User::TABLE_ROLE => User::ROLE_ADMIN,
        ];
        $originUser = User::where(User::TABLE_ROLE, User::ROLE_USER)->get()->first();
        $this->assertNotEmpty($originUser);

        $currentUser = User::find($originUser->id);
        $this->assertNotEmpty($currentUser);
        $this->assertTrue($currentUser->update($attributes));

        $user = User::find($originUser->id);
        $this->assertNotEmpty($user);
        foreach ($attributes as $key => $value) {
            $this->assertNotEquals(
                $user->getAttribute($key),
                $originUser->getAttribute($key)
            );
        }
    }

    public function testDelete()
    {
        $user = factory(User::class)->create([User::TABLE_ROLE => User::ROLE_USER]);
        $this->assertNotEmpty($user);
        $this->assertTrue($user->delete());
    }

    public function testCreateUserRoleAdmin()
    {
        $user = $this->createUser($this->getDummyTestUsers(User::ROLE_ADMIN));
        $this->assertTrue($user->isRoleAdmin());
    }


    public function testCreateUserRoleUser()
    {
        $user = $this->createUser($this->getDummyTestUsers(User::ROLE_USER));
        $this->assertTrue($user->isRoleUser());
    }

    /**
     * @param $data
     * @return Model|mixed
     */
    private function createUser($data)
    {
        return factory(User::class)->create($data);
    }

    /**
     * @param string $role
     * @return array
     */
    private function getDummyTestUsers(string $role)
    {
        $roles = [
            User::ROLE_ADMIN => [
                'username' => 'TestAdmin',
                'email' => 'testadmin@todolist.development',
                'password' => Hash::make(env('TEST_ADMIN_PASSWORD')),
                'role' => User::ROLE_ADMIN,
                'remember_token' => Str::random(10)
            ],
            User::ROLE_USER => [
                'username' => 'TestUser',
                'email' => 'testuser@todolist.development',
                'email_verified_at' => now(),
                'password' => Hash::make(env('TEST_USER_PASSWORD')),
                'role' => User::ROLE_USER,
                'remember_token' => Str::random(10),
            ]
        ];
        return $roles[$role];
    }
}
