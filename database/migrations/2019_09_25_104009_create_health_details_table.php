<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('used_contraceptive_device');
            $table->boolean('type_of_contraceptive_device')->nullable();
            $table->string('contraceptive_device')->nullable();
            $table->smallInteger('age_of_first_mensuration')->unsigned();
            $table->boolean('menopause');
            $table->smallInteger('age_of_menopause')->unsigned()->nullable();
            $table->boolean('have_health_problem');
            $table->string('health_problem')->nullable();
            $table->unsignedInteger('women_id')->unsigned();
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
        Schema::dropIfExists('health_details');
    }
}
