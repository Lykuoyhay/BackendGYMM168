<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id('resource_id');
            $table->string('title')->nullable();
            $table->string('type'); // 'article' or 'exercise'
            $table->string('subtitle')->nullable();
            $table->string('author')->nullable();
            $table->string('img_cover')->nullable();
            $table->text('paragraph1')->nullable();
            $table->string('paragraph1_img')->nullable();
            $table->text('paragraph2')->nullable();
            $table->string('paragraph2_img')->nullable();
            $table->string('exercise_type')->nullable();
            $table->string('exercise_muscle')->nullable();
            $table->string('exercise_equipment')->nullable();
            $table->string('exercise_difficulty')->nullable();
            $table->text('exercise_description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
