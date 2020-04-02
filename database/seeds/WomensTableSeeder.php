<?php

use Illuminate\Database\Seeder;

class WomensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Women::class, 100)->create();
    }
}
