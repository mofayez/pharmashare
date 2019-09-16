<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drug_store_id')->unsigned();
            $table->integer('foc_quantity')->unsigned();
            $table->double('foc_discount')->unsigned();
            $table->timestamps();

            $table->foreign('drug_store_id')->references('id')->on('drug_stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foc');
    }
}
