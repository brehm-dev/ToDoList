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
        factory(User::class, 1)->create(['role' => User::ROLE_USER])->relationsToArray();
//        factory(User::class, 1)->create(['role' => User::ROLE_ADMIN]);
    }
}
