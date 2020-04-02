<?php

use Illuminate\Database\Seeder;

class ChildMarriagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ChildMarriage::class, 100)->create();
    }
}
