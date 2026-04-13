<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArtikelKategoriUuidToArticlesTable extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // New FK column — nullable, placed right after the old kategori text
            $table->string('artikel_kategori_uuid')->nullable()->after('kategori');
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('artikel_kategori_uuid');
        });
    }
}
