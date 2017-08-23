<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('job_number')->unique()->comment('工号');
            $table->string('name')->comment('姓名');
            $table->string('mobile')->comment('手机号');
            $table->integer('department_id')->unsigned()->comment('所属部门ID');
            $table->string('password')->comment('密码');
            $table->unsignedTinyInteger('sort')->default(100)->comment('排序字段,越小越靠前');
            $table->timestamps();
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
