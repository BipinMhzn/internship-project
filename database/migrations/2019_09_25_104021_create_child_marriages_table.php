<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildMarriagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_marriages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('know_child_marriage');
            $table->string('child_marriage')->nullable();
            $table->string('girl_marry_age');
            $table->string('boy_marry_age');
            $table->string('first_child_age');
            $table->boolean('know_marriage_laws');
            $table->string('marriage_laws')->nullable();
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
        Schema::dropIfExists('child_marriages');
    }
}
