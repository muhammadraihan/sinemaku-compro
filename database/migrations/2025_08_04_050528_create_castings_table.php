<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCastingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('castings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('pemeran')->nullable();
            $table->string('judul_film')->nullable();
            $table->string('gender')->nullable();
            $table->string('umur')->nullable();
            $table->string('location')->nullable();
            $table->longText('detail')->nullable();
            $table->date('deadline')->nullable();
            $table->string('link')->nullable();
            $table->string('shoot_date')->nullable();
            $table->string('created_by')->nullable();
            $table->string('edited_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('castings');
    }
}
