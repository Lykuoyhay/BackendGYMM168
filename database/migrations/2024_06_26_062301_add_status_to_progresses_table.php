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
        Schema::table('progresses', function (Blueprint $table) {
            $table->string('status')->default('Done'); // Adding a default status value
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('progresses', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
