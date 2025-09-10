<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToMultipleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     private array $tables = [
        'films',
        'shops',
        'articles',
        'jobs',
        'castings',
        'events'
    ];

    public function up()
    {
        foreach ($this->tables as $t) {
            if (!Schema::hasColumn($t, 'slug')) {
                Schema::table($t, function (Blueprint $table) {
                    // gunakan string, bukan longText, agar bisa diindex/unique
                    $table->string('slug', 191)->nullable()->unique();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $t) {
            if (Schema::hasColumn($t, 'slug')) {
                Schema::table($t, function (Blueprint $table) {
                    // kalau takut soal index name, cukup dropColumn — di MySQL index unik akan ikut hilang
                    $table->dropColumn('slug');
                });
                // Jika kamu ingin drop index unik dulu, bisa pakai:
                // Schema::table($t, function (Blueprint $table) use ($t) {
                //     $table->dropUnique($t . '_slug_unique'); // nama index default: {table}_{column}_unique
                //     $table->dropColumn('slug');
                // });
            }
        }
    }
}
