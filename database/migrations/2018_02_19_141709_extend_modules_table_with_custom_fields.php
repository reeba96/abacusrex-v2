<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendModulesTableWithCustomFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('modules'))
        {
            Schema::table('modules', function (Blueprint $table) {
                $table->boolean('page_top')->nullable();
                $table->boolean('page_tab')->nullable();
                $table->boolean('page_content')->nullable();
                $table->boolean('article_top')->nullable();
                $table->boolean('article_tab')->nullable();
                $table->boolean('article_content')->nullable();
                $table->boolean('main_menu')->nullable();
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
        Schema::table('modules', function (Blueprint $table) {
            $table->dropColumn(['page_top', 'page_tab', 'page_content', 'article_top', 'article_tab', 'article_content', 'main_menu']);
        });
    }
}
