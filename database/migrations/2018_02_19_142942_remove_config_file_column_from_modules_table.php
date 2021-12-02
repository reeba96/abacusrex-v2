<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveConfigFileColumnFromModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('modules')) {
            Schema::table('modules', function(Blueprint $table) {
                $table->dropColumn('config_file'); 
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modules', function(Blueprint $table) {
            $table->string('config_file')->nullable();
        });
    }
}
