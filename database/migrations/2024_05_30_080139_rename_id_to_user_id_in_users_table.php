<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIdToUserIdInUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the existing primary key
            $table->dropPrimary('id');

            // Rename the column from 'id' to 'user_id'
            $table->renameColumn('id', 'user_id');

            // Set the new column as the primary key
            $table->primary('user_id');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the primary key on 'user_id'
            $table->dropPrimary('user_id');

            // Rename the column back from 'user_id' to 'id'
            $table->renameColumn('user_id', 'id');

            // Set the 'id' column as the primary key again
            $table->primary('id');
        });
    }
}
