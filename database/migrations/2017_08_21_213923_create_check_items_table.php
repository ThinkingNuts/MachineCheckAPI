<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_type_id')->unsigned()->comment('设备类型ID');
            $table->integer('check_period_id')->unsigned()->comment('检查周期ID');
            $table->string('name')->comment('检查项名称');
            $table->enum('check_type', ['巡检', '点检'])->index()->comment('检查项所属类型');
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
        Schema::dropIfExists('check_items');
    }
}
