<?php

use Illuminate\Database\Seeder;
use UDF\Sala;

class SalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Sala::class, 10)->create();
    }
}
