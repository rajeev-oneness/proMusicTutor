<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaxLessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sax_lessions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('categoryId');
            $table->bigInteger('saxSeriesId');
            $table->string('title');
            $table->string('image');
            $table->integer('currencyId');
            $table->float('price',8,2);
            $table->longText('description');
            $table->string('video_url');
            $table->float('gbp',8,2);
            $table->float('usd',8,2);
            $table->float('euro',8,2);
            $table->string('keywords')->nullable();
            $table->string('genre')->nullable();
            $table->string('product_code');
            $table->bigInteger('createdBy');
            $table->enum('status', [0, 1])->default(1)->comment('1=Active,0=Inactive');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [];
        for ($i=0; $i < 3; $i++) {
            for ($j=0; $j < 6; $j++) {
                for ($k=0; $k < 3 ; $k++) {
                    $data[] = [
                        'categoryId' => ($i+1),
                        'saxSeriesId' => ($j+1),
                        'title' => 'Series '.($i+1).' - Lesson '.($k+1),
                        'image' => '/design/img/guitar_'.(4+$k).'.png',
                        'currencyId' => 3,
                        'price' => rand(2,9).'.99',
                        'description' => "During this series you will be taught and directed by the legendary 'Whitesnake' guitarist, Micky Moody. Throughtout the lessons he'll demonstrate valuable riffs, licks and ideas across a number of styles, including; Bluegrass, Blues, slide and will demonstrate some of his own work using unusual tuning methods. He will demonstrate some of the methods he uses and goes into detail as to slide and picking techniques This series is perfect for the seasoned guitarist - so bring your bottleneck, capo and don't worry - you're in good hands with Micky Moody",
                        'video_url' => 'https://player.vimeo.com/video/137857207',
                        'gbp' => rand(5,9).'.99',
                        'usd' => rand(5,9).'.99',
                        'euro' => rand(5,9).'.99',
                        'product_code' => 'MM-ACS1-',
                        'createdBy' => (2+$i),
                    ];
                }
            }
        }
        DB::table('sax_lessions')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sax_lessions');
    }
}
