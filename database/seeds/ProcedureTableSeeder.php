<?php

use App\Procedure;
use Illuminate\Database\Seeder;

class ProcedureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Procedure::class, 100)->create();
    }
}
