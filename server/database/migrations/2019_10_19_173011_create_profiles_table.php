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
            $table->boolean('gender');
            $table->date('birthday');
            $table->string('favorite_food');
            $table->string('hated_food');
            $table->string('img_file');
            $table->integer('personality_1');
            $table->integer('personality_2');
            $table->integer('personality_3');
            $table->integer('personality_4');
            $table->integer('personality_5');
            $table->integer('personality_6');
            $table->integer('age_1');
            $table->integer('age_2');
            $table->integer('age_3');
            $table->integer('age_4');
            $table->integer('age_5');
            $table->integer('age_6');
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
