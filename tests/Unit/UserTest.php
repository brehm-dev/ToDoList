<?php

namespace Tests\Unit;

use App\User;
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

    public function testCreate()
    {
        $instance = factory(User::class)->create([User::TABLE_ROLE => User::ROLE_USER]);
        $this->assertTrue($instance->wasRecentlyCreated);
    }

    public function testUpdate()
    {
        $this->refreshDatabase();
        Artisan::call('db:seed');
        sleep(2);
        $attributes = [
            User::TABLE_LAST_NAME => $this->faker->lastName,
            User::TABLE_FIRST_NAME => $this->faker->firstName,
            User::TABLE_EMAIL => $this->faker->safeEmail,
            User::TABLE_ROLE => User::ROLE_MASTER,
            User::UPDATED_AT => now()
        ];
        $originUser = User::where(User::TABLE_ROLE, User::ROLE_USER)->first();
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
        $this->assertTrue($user->roleIsAdmin());
    }

    public function testCreateUserRoleMaster()
    {
        $user = $this->createUser($this->getDummyTestUsers(User::ROLE_MASTER));
        $this->assertTrue($user->roleIsMaster());
    }

    public function testCreateUserRoleUser()
    {
        $user = $this->createUser($this->getDummyTestUsers(User::ROLE_USER));
        $this->assertTrue($user->roleIsUser());
    }



    /**
     * @param $data
     * @return \Illuminate\Database\Eloquent\Model|mixed
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
                'first_name' => 'TestFirstNameAdmin',
                'last_name' => 'TestLastNameAdmin',
                'email' => 'testadmin@todolist.development',
                'email_verified_at' => now(),
                'password' => Hash::make(env('TEST_ADMIN_PASSWORD')),
                'role' => User::ROLE_ADMIN,
                'remember_token' => Str::random(10)
            ],
            User::ROLE_MASTER => [
                'first_name' => 'TestFirstNameMaster',
                'last_name' => 'TestLastNameMaster',
                'email' => 'testmaster@todolist.development',
                'email_verified_at' => now(),
                'password' => Hash::make(env('TEST_MASTER_PASSWORD')),
                'role' => User::ROLE_MASTER,
                'remember_token' => Str::random(10)
            ],
            User::ROLE_USER => [
                'first_name' => 'TestFirstNameUser',
                'last_name' => 'TestLastNameUser',
                'email' => 'testuser@todolist.development',
                'email_verified_at' => now(),
                'password' => Hash::make(env('TEST_USER_PASSWORD')),
                'role' => User::ROLE_USER,
                'remember_token' => Str::random(10)
            ]
        ];
        return $roles[$role];
    }
}
