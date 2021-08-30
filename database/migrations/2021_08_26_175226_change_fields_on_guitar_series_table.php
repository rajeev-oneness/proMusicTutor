<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsOnGuitarSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guitar_series', function (Blueprint $table) {
            $table->dropColumn('difficulty');
            $table->dropColumn('genre');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guitar_series', function (Blueprint $table) {
            $table->tinyInteger('genre')->after('euro');
            $table->tinyInteger('difficulty', ['Medium', 'Easy', 'Outher'])->after('genre');
        });
    }
}
