<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentary', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('kategori')->nulable();
            $table->string('title')->nullable();
            $table->string('genre')->nullable();
            $table->date('release_date')->nullable();
            $table->longText('sinopsis')->nullable();
            $table->string('duration')->nullable();
            $table->string('season')->nullable();
            $table->string('episode')->nullable();
            $table->string('director')->nullable();
            $table->longText('cast')->nullable();
            $table->longText('link')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('documentary');
    }
}
