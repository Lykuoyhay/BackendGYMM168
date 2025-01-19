<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workoutplans', function (Blueprint $table) {
            $table->id('workoutplan_id'); // Custom primary key
            $table->string('course_name');
            $table->string('course_type');
            $table->string('schedule');
            $table->string('duration');
            $table->string('requirement');
            $table->decimal('price', 8, 2); // Precision of 8, scale of 2
            $table->text('course_description');
            $table->string('course_image');
            $table->unsignedBigInteger('user_id'); // Foreign key referencing the User model

            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workoutplans');
    }
}
