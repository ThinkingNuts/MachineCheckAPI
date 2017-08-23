<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workplace_id')->unsigned()->comment('工位ID');
            $table->integer('device_type_id')->unsigned()->comment('设备类型ID');
            $table->integer('number')->unique()->comment('设备编号');
            $table->integer('name')->comment('设备名称');
            $table->integer('manufacturer')->nullable()->comment('设备出产商');
            $table->integer('production_date')->nullable()->comment('设备出产日期');
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
        Schema::dropIfExists('devices');
    }
}
