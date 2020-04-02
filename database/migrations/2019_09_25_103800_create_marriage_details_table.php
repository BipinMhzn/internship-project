<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarriageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marriage_details', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('age_of_marriage')->unsigned();
            $table->smallInteger('number_of_years_of_marriage')->unsigned();
            $table->smallInteger('number_of_sons')->unsigned()->nullable();
            $table->smallInteger('number_of_daughters')->unsigned()->nullable();
            $table->smallInteger('number_of_others')->unsigned()->nullable();
            $table->unsignedInteger('women_id');
            $table->timestamps();

            $table->foreign('women_id')->references('id')->on('womens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marriage_details');
    }
}
