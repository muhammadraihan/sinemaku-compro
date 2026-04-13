<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('film_uuid');            // FK → films.uuid (Series or TV)
            $table->integer('season_number')->default(1);
            $table->integer('episode_number')->default(1);
            $table->string('title')->nullable();
            $table->longText('sinopsis')->nullable();
            $table->string('duration')->nullable();  // e.g. "45 mnt"
            $table->longText('link')->nullable();     // YouTube / streaming URL
            $table->string('photo')->nullable();      // thumbnail filename
            $table->string('slug', 191)->nullable()->unique();
            $table->string('created_by')->nullable();
            $table->string('edited_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
