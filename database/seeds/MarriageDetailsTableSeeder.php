<?php

use Illuminate\Database\Seeder;

class MarriageDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\MarriageDetail::class, 100)->create()->each(function ($marriage_detail){
            $number_of_children = $marriage_detail->number_of_sons + $marriage_detail->number_of_daughters + $marriage_detail->number_of_others;

            factory(\App\AgeDuringChildBirth::class, $number_of_children)->create([
                'marriage_detail_id' => $marriage_detail->id
            ]);
        });
    }
}
