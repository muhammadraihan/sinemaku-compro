<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnColumnsToDynamicTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('films', 'title_en')) {
            Schema::table('films', function (Blueprint $table) {
                $table->string('title_en')->nullable()->after('title');
                $table->text('sinopsis_en')->nullable()->after('sinopsis');
                $table->string('genre_en')->nullable()->after('genre');
            });
        }

        if (!Schema::hasColumn('events', 'judul_en')) {
            Schema::table('events', function (Blueprint $table) {
                $table->string('judul_en')->nullable()->after('judul');
                $table->text('detail_en')->nullable()->after('detail');
                $table->string('location_en')->nullable()->after('location');
            });
        }

        if (!Schema::hasColumn('articles', 'judul_en')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->string('judul_en')->nullable()->after('judul');
                $table->string('title_en')->nullable()->after('title'); // this is excerpt
                $table->text('detail_en')->nullable()->after('detail');
            });
        }

        if (!Schema::hasColumn('jobs', 'position_en')) {
            Schema::table('jobs', function (Blueprint $table) {
                $table->string('position_en')->nullable()->after('position');
                $table->text('detail_en')->nullable()->after('detail');
            });
        }

        if (!Schema::hasColumn('castings', 'pemeran_en')) {
            Schema::table('castings', function (Blueprint $table) {
                $table->string('pemeran_en')->nullable()->after('pemeran');
                $table->text('detail_en')->nullable()->after('detail');
            });
        }

        if (!Schema::hasColumn('shops', 'name_en')) {
            Schema::table('shops', function (Blueprint $table) {
                $table->string('name_en')->nullable()->after('name');
                $table->string('judul_en')->nullable()->after('judul');
                $table->text('detail_en')->nullable()->after('detail');
            });
        }

        if (!Schema::hasColumn('site_settings', 'value_en')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->text('value_en')->nullable()->after('value');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'sinopsis_en', 'genre_en']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['judul_en', 'detail_en', 'location_en']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['judul_en', 'title_en', 'detail_en']);
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['position_en', 'detail_en']);
        });

        Schema::table('castings', function (Blueprint $table) {
            $table->dropColumn(['pemeran_en', 'detail_en']);
        });

        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'judul_en', 'detail_en']);
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('value_en');
        });
    }
}
