<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    const USER_INDEX = '/users';
    const USER_VIEW = '/user/{user}';

    const ADMIN = [
        'email'     => 'todolist@test.admin',
        'password'  => 'C0B8yV76CWNunFBMXC%E3qyp2moBy-pi',
        'role' => User::ROLE_ADMIN
    ];
    const USER = [
        'email' => 'todolist@test.user',
        'username' => 'ToDoListUnitTesterUser',
        'password' => 'H1Mxf8UyS2FhGk9PAb5%YI2OdEVGkVaQ',
        'role' => User::ROLE_USER
    ];

    public function testIndex()
    {
        $response = $this->get(self::USER_INDEX);
        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }

    public function testView()
    {
        $this->refreshDatabase();
        $user = User::create(self::ADMIN);
        $route = str_replace('{user}', $user->id, self::USER_VIEW);
        $response = $this->actingAs($user)->get($route);
        $response->assertJson(['email' => self::ADMIN['email']]);

    }

    public function testUpdate()
    {
        $this->refreshDatabase();
        $user = User::create(self::ADMIN);
        $route = str_replace('{user}', $user->id, self::USER_VIEW);
        $response = $this->actingAs($user)->patch($route, [
            'username' => 'NewAdminUserName',
            'email' => 'test@e.mail',
            'role' => User::ROLE_ADMIN
        ]);
        $response->assertJson(['role' => User::ROLE_ADMIN]);
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $this->refreshDatabase();
        $creator = User::create(self::ADMIN);
        $route = str_replace('{user}', '', self::USER_VIEW);
        $preUser = self::USER;
        $preUser['password_confirmation'] = self::USER['password'];
        $response = $this->actingAs($creator)->post($route, $preUser);
        $response->assertStatus(201);
        $response->assertJson(['role' => User::ROLE_USER]);
    }
}
