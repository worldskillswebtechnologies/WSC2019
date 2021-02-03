<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('registration_id');
            $table->enum('rating', [1,2,3,4,5]);
            $table->text('comment');
            $table->timestamps();

            $table->foreign('registration_id')->on('registrations')->references('id');
        });

        Schema::create('session_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_registration_id');
            $table->enum('rating', [1,2,3,4,5]);
            $table->timestamps();

            $table->foreign('session_registration_id')->on('session_registrations')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_ratings');
        Schema::dropIfExists('session_ratings');
    }
}
