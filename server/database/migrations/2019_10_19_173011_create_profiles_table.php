<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); 
            // 親テーブルのincrements()のせいで符号付だからunsigned()がないとエラーになる
            $table->string('name');
            $table->boolean('gender')->default(0);
            $table->date('birthday')->default('1900-01-01');
            $table->string('favorite_food')->default('');;
            $table->string('hated_food')->default('');
            $table->string('img_file')->default('/storage/profiles/mysteryman.png');
            $table->integer('personality_1')->default(0);
            $table->integer('personality_2')->default(0);
            $table->integer('personality_3')->default(0);
            $table->integer('personality_4')->default(0);
            $table->integer('personality_5')->default(0);
            $table->integer('personality_6')->default(0);
            // $table->integer('age_1');
            // $table->integer('age_2');
            // $table->integer('age_3');
            // $table->integer('age_4');
            // $table->integer('age_5');
            // $table->integer('age_6');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
