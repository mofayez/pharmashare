<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnApprovedDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('un_approved_drugs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_store_id')->unsigned();
            $table->integer('drug_category_id')->unsigned();
            $table->string('pharmashare_code')->nullable();
            $table->string('trade_name', 255)->nullable();
            $table->string('form', 255)->nullable();
            $table->string('pack_size')->nullable();
            $table->text('active_ingredient')->nullable();
            $table->text('strength')->nullable();
            $table->string('manufacturer', 255)->nullable();
            $table->bigInteger('offered_price_or_bonus')->nullable();
            $table->bigInteger('available_quantity_in_packs')->nullable();
            $table->bigInteger('minimum_order_value_or_quantity')->nullable();
            $table->text('store_remarks')->nullable();
            $table->timestamps();

            $table->foreign('user_store_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('drug_category_id')->references('id')->on('drug_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('un_approved_drugs');
    }
}
