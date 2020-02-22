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
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            // 親テーブルのincrements()のせいで符号付だからunsigned()がないとエラーになる
            $table->integer('dept_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->boolean('is_admin')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('dept_id')->references('id')->on('depts');
            $table->foreign('job_id')->references('id')->on('jobs');
        });
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
