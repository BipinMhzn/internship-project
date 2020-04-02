<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeDuringChildBirthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_during_child_births', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('age_during_child_birth')->unsigned();
            $table->unsignedInteger('marriage_detail_id');
            $table->timestamps();

            $table->foreign('marriage_detail_id')->references('id')->on('marriage_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('age_during_child_births');
    }
}
