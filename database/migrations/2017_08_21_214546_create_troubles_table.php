<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTroublesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('troubles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('故障原因');
            $table->timestamps();
        });

        Schema::create('check_item_trouble', function (Blueprint $table) {
            $table->integer('check_item_id')->unsigned()->comment('检查项ID');
            $table->integer('trouble_id')->unsigned()->comment('故障原因ID');

            $table->foreign('check_item_id')->references('id')->on('check_items')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('trouble_id')->references('id')->on('troubles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['check_item_id', 'trouble_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('troubles');
        Schema::dropIfExists('check_item_trouble');
    }
}
