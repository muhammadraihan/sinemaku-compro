<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->longText('name')->nullable();
            $table->longText('judul')->nullable();
            $table->longText('detail')->nullable();
            $table->string('harga')->nullable();
            $table->string('discount')->nullable();
            $table->longText('link')->nullable();
            $table->string('photo')->nullable();
            $table->string('highlight')->nullable();
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
        Schema::dropIfExists('shops');
    }
}
