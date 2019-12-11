<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->increments('id');
            // 親テーブルのincrements()のせいで符号付だからunsigned()がないとエラーになる
            $table->integer('user_id')->unsigned(); 
            $table->date('date');
            $table->time('start_time');
            $table->time('break_time');
            $table->time('end_time');
            $table->float('actual', 3, 2);
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
        Schema::dropIfExists('attendance_records');
    }
}
