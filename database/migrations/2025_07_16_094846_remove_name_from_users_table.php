<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNameFromUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable(); 
        });
    }
}
