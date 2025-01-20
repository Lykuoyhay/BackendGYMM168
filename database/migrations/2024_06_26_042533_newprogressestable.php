<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('progresses', function (Blueprint $table) {
            $table->id('progress_id');
            $table->integer('workout_set');
            $table->integer('workout_duration');
            $table->integer('calories_burn');
            $table->string('status')->default('Done');
            $table->unsignedBigInteger('id');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progresses');
    }
};
