<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_holidays', function (Blueprint $table) {
            $table->increments('id');
            // 親テーブルのincrements()のせいで符号付だからunsigned()がないとエラーになる
            $table->integer('user_id')->unsigned(); 
            $table->date('grant_date');
            $table->date('expire_date');
            $table->date('use_date')->nullable()->default(null);
            $table->integer('status')->nullable()->default(0);
            $table->date('application_date')->nullable()->default(null);
            $table->string('comment')->nullable()->default(null);
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
        Schema::dropIfExists('paid_holidays');
    }
}
