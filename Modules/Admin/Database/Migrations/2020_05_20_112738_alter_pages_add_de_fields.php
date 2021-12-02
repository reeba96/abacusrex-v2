<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPagesAddDeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('title_de',255)->after('title_en')->nullable();
            $table->string('description_de',255)->after('description_en')->nullable();
            $table->string('url_de',255)->after('url_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('title_de');
            $table->dropColumn('description_de');
            $table->dropColumn('url_de');
        });
    }
}
