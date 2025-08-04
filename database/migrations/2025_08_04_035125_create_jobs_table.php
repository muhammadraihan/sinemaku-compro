<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('position')->nullable();
            $table->string('tim')->nullable();
            $table->string('location')->nullable();
            $table->string('salary')->nullable();
            $table->string('pengalaman')->nullable();
            $table->longText('detail')->nullable();
            $table->string('status')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
