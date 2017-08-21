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
            $table->enum('is_repaired', ['T', 'F'])->nullable()->index()->comment('设备是否已维修');
            $table->string('superior_opinion')->nullable()->comment('班组长意见');
            $table->string('repair_opinion')->nullable()->comment('维修意见');
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
