<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldOnCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('video_url')->after('description')->nullable();
            // $table->string('item_clean_url')->after('video')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('video_url');
            // $table->dropColumn('item_clean_url');
        });
    }
}
