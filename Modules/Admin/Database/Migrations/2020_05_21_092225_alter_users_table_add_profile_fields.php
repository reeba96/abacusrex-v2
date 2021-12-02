<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableAddProfileFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firm',255)->after('email')->nullable();
            $table->string('title',255)->after('firm')->nullable();
            $table->string('mobile',255)->after('firm')->nullable();
            $table->string('phone',255)->after('mobile')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('firm');
            $table->dropColumn('title');
            $table->dropColumn('mobile');
            $table->dropColumn('phone');
        });
    }
}
