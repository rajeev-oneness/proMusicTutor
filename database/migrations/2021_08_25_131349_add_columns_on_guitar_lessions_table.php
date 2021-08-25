<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOnGuitarLessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guitar_lessions', function (Blueprint $table) {
            $table->string('video_url')->after('description');
            $table->float('gbp',8,2)->after('video_url');
            $table->float('usd',8,2)->after('gbp');
            $table->float('euro',8,2)->after('usd');
            $table->string('keywords')->nullable()->after('euro');
            $table->string('genre')->nullable()->after('keywords');
            $table->string('product_code')->after('genre');
            $table->enum('status', [0, 1])->default(1)->comment('1=Active,0=Inactive')->after('product_code');
           
        });
        $data = [];
        for ($i=0; $i < 3; $i++) {
            for ($j=0; $j < 6; $j++) {
                for ($k=0; $k < 3 ; $k++) {
                    $data[] = [
                        'video_url' => 'https://player.vimeo.com/video/137857207',
                        'gbp' => rand(5,9).'.99',
                        'usd' => rand(5,9).'.99',
                        'euro' => rand(5,9).'.99',
                        'product_code' => 'MM-ACS1-',
                    ];
                }
            }
        }
        DB::table('guitar_lessions')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guitar_lessions', function (Blueprint $table) {
            $table->dropColumn('video_url');
            $table->dropColumn('gbp');
            $table->dropColumn('usd');
            $table->dropColumn('euro');
            $table->dropColumn('keywords');
            $table->dropColumn('genre');
            $table->dropColumn('product_code');
            $table->dropColumn('status');
        });
    }
}
