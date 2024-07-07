<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->increments('exercise_id');
            $table->string('exercise_name', 100);
            $table->string('exercise_type', 50);
            $table->string('exercise_muscle', 50);
            $table->string('exercise_equipment', 50)->nullable();
            $table->string('exercise_difficulty', 20);
            $table->text('exercise_description')->nullable();
            $table->string('exercise_cover', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
