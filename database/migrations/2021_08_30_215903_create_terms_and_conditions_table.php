<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsAndConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms_and_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('page_cleane_url');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
           
            [
                'title' => '',
                'description' => 'Pro Music Tutor offers a range of high definition music tutoring videos and exceptional quality backing tracks. Our instructional videos feature tutors selected for their reputation and talent with the guitar and with the saxophone.',
                'page_cleane_url' => ''
            ]
        ];
        DB::table('terms_and_conditions')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms_and_conditions');
    }
}
