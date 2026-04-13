<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEpisodeUuidToFilmGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('film_galleries', function (Blueprint $table) {
            $table->string('film_uuid')->nullable()->change();
            $table->string('episode_uuid')->nullable()->after('film_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('film_galleries', function (Blueprint $table) {
            $table->string('film_uuid')->nullable(false)->change();
            $table->dropColumn('episode_uuid');
        });
    }
}
