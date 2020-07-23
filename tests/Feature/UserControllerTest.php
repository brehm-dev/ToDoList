<?php

namespace Tests\Feature;

use App\Schedule;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    const CREDENTIALS = [
        'username'  => 'FeatureTestUser72020',
        'email'     => 'testuser@feature.test',
        'password'  => 'H1Mxf8UyS2FhGk9PAb5%YI2OdEVGkVaQ'
    ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRoot()
    {
        $response = $this->get('/');
        $response->assertSuccessful();
        $response->assertStatus(200);
    }

    public function testCreateUserRoute()
    {
        $this->refreshDatabase();
        $defaultSchedule = Schedule::checkAndSetDefault();
        $user = [
            'username' => self::CREDENTIALS['username'],
            'email' => self::CREDENTIALS['email'],
            'password' => self::CREDENTIALS['password'],
            'default_schedule_id' => $defaultSchedule->getAttribute('id'),
            'role' => User::ROLE_USER
        ];
        $response = $this->post('/user', $user);
        $response->assertStatus(302);

        $view = $this->get($response->headers->get('location'));
        $view->assertSuccessful();
    }

}
