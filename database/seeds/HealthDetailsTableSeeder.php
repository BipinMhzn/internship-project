<?php

use Illuminate\Database\Seeder;

class HealthDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\HealthDetail::class, 100)->create();
    }
}
