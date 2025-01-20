<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id'); // Custom primary key
            $table->string('room_name');
            $table->unsignedBigInteger('id'); // Foreign key referencing the User model
            $table->unsignedBigInteger('workoutplan_id'); // Foreign key referencing the WorkoutPlan model

            $table->timestamps();

            // Define the foreign key constraints
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('workoutplan_id')->references('workoutplan_id')->on('workoutplans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
