<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drug_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->double('price')->nullable();
            $table->bigInteger('offered_price_or_bonus')->nullable();
            $table->bigInteger('available_quantity_in_packs')->nullable();
            $table->bigInteger('minimum_order_value_or_quantity')->nullable();
            $table->text('store_remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('drug_id')->references('id')->on('drugs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_stores');
    }
}
