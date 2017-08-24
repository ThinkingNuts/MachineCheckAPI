<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id')->unsigned()->comment('设备ID');
            $table->string('measures')->unsigned()->comment('采取措施');
            $table->string('superior_opinion')->nullable()->comment('班组长意见');
            $table->string('repair_opinion')->nullable()->comment('维修意见');
            $table->enum('is_repaired', ['T', 'F'])->nullable()->index()->comment('设备是否已维修');
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
        Schema::dropIfExists('repair_records');
    }
}
