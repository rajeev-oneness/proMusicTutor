<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenreAndDefficultyOnSaxSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sax_series', function (Blueprint $table) {
            $table->string('genre')->after('euro');
            $table->enum('difficulty', ['Medium', 'Easy', 'Other'])->after('genre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sax_series', function (Blueprint $table) {
            $table->dropColumn('difficulty');
            $table->dropColumn('genre');
        });
    }
}
