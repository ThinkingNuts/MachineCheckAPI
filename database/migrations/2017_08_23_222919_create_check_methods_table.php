<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('method')->comment('检查方式');
            $table->timestamps();
        });

        Schema::create('item_method', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('check_item_id')->unsigned()->comment('检查项ID');
            $table->integer('check_method_id')->unsigned()->comment('检查方式ID');
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
        Schema::dropIfExists('check_methods');
        Schema::dropIfExists('item_method');
    }
}
