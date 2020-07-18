<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create(['role' => User::ROLE_USER]);
        factory(User::class, 5)->create(['role' => User::ROLE_MASTER]);
        factory(User::class, 3)->create(['role' => User::ROLE_ADMIN]);
    }
}
