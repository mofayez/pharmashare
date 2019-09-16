<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugStoreDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_store_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drug_store_id')->unsigned();
            $table->bigInteger('amount')->nullable();
            $table->string('expiration_date')->nullable();
            $table->double('price')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('drug_store_details');
    }
}
