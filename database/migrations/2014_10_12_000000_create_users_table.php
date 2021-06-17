<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_type')->default(3);
            $table->string('name');
            $table->string('email',150)->unique();
            $table->string('mobile',20);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('otp',10);
            $table->tinyInteger('subscribed')->default(1)->comment('1:Subscribed ,0:Un-Subscribed');
            $table->tinyInteger('status')->comment('1:Active,0:In-Active')->default(1);
            $table->string('image')->default('/defaultImages/user.jpg');
            $table->string('referral_code',10)->unique()->comment('Referral Code');
            $table->bigInteger('referred_by')->comment('Referred By UserId');
            $table->string('gender',20)->comment('Male,Female,Not specified');
            $table->date('dob');
            $table->string('marital',20)->comment('Single,Married,Divorced');
            $table->date('aniversary');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            [
                'user_type' => 1,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('secret'),
                'referral_code' => 'AAAAAAA',
            ],
            [
                'user_type' => 2,
                'name' => 'Tutor',
                'email' => 'tutor@tutor.com',
                'password' => Hash::make('secret'),
                'referral_code' => 'AAAAAAB',
            ],
            [
                'user_type' => 3,
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => Hash::make('secret'),
                'referral_code' => 'AAAAAAC',
            ],
        ];

        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
