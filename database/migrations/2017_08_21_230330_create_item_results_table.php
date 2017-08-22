<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_result_id')->unsigned()->comment('设备检查结果ID');
            $table->integer('check_item_id')->unsigned()->comment('检查项ID');
            $table->enum('is_normal', ['T', 'F'])->default('T')->index()->comment('该检查项是否正常');
            $table->integer('trouble_id')->unsigned()->comment('故障原因ID');
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
        Schema::dropIfExists('item_results');
    }
}
