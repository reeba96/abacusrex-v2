<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterArticleAddDeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('title_de',255)->after('title_en')->nullable();
            $table->string('subtitle_de',255)->after('subtitle_en')->nullable();
            $table->string('content_de',255)->after('content_en')->nullable();
            $table->string('description_de',255)->after('description_en')->nullable();
            $table->string('url_de',255)->after('url_en')->nullable();
            $table->string('author_de',255)->after('author_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('title_de');
            $table->dropColumn('subtitle_de');
            $table->dropColumn('content_de');
            $table->dropColumn('description_de');
            $table->dropColumn('url_de');
            $table->dropColumn('author_de');
        });
    }
}
