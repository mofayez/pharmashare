<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drug_category_id')->unsigned();
//            $table->integer('user_id')->unsigned();
            $table->string('pharmashare_code')->nullable();
            $table->string('trade_name', 255)->nullable();
            $table->string('form', 255)->nullable();
            $table->string('pack_size')->nullable();
            $table->text('active_ingredient')->nullable();
            $table->text('strength')->nullable();
            $table->string('manufacturer', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('drug_category_id')->references('id')->on('drug_categories')->onDelete('cascade');
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drugs');
    }
}
