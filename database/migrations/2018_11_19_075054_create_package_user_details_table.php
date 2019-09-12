<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_user_id')->unsigned();
            $table->integer('drug_store_id')->unsigned();
            $table->timestamps();

            $table->foreign('drug_store_id')->references('id')->on('drug_stores')->onDelete('cascade');
            $table->foreign('package_user_id')->references('id')->on('package_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_user_details');
    }
}
