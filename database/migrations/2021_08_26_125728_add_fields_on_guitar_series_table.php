<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsOnGuitarSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guitar_series', function (Blueprint $table) {
            // $table->float('price',8,2)->after('description');
            $table->float('gbp',8,2)->after('description')->nullable();
            $table->float('usd',8,2)->after('gbp');
            $table->float('euro',8,2)->after('usd');
            $table->string('genre')->after('euro')->nullable();
            $table->string('difficulty')->after('genre');
            $table->string('seo_meta_description')->after('difficulty');
            $table->string('seo_meta_keywords')->after('seo_meta_description')->nullable();
            $table->string('related_series')->after('seo_meta_keywords')->nullable();
        });

        $series = DB::table('sax_series')->get();
        foreach ($series as $key => $value) {
            DB::table('sax_series')->where('id',$value->id)->update( [
                // 'price' => rand(5,9).'.99',
                'usd' => rand(5,9).'.99',
                'euro' => rand(5,9).'.99',
                'difficulty' => 'true',
                'seo_meta_description' => 'Acoustic Series 1',
                'seo_meta_keywords' => 'Acoustic Series 1',
            ]);
        }
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guitar_series', function (Blueprint $table) {
            // $table->dropColumn('price');
            $table->dropColumn('gbp');
            $table->dropColumn('usd');
            $table->dropColumn('euro');
            $table->dropColumn('genre');
            $table->dropColumn('difficulty');
            $table->dropColumn('seo_meta_description');
            $table->dropColumn('seo_meta_keywords');
            $table->dropColumn('related_series');
        });
    }
}
