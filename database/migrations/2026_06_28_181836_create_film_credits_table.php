<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('film_credits', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('film_id');

            $table->string('role');
            $table->string('name');

            $table->timestamps();

            $table->foreign('film_id')
                  ->references('id')
                  ->on('films')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('film_credits');
    }
}
