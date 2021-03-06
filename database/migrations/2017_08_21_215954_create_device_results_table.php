<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id')->unsigned()->comment('设备ID');
            $table->integer('user_id')->unsigned()->comment('检查人ID');
            $table->enum('is_normal', ['T', 'F'])->default('T')->index()->comment('设备是否正常');
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
        Schema::dropIfExists('device_results');
    }
}
