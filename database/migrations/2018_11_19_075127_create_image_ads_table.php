<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_ads', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('created_by_admin')->default(0);
            $table->tinyInteger('approved')->default(0);
            $table->timestamp('paid_at')->nulable();
            $table->integer('show_queue')->default(0);
            $table->tinyInteger('open')->default(1);
            $table->integer('image_ad_type_id')->unsigned();
            $table->integer('image_package_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('valid_until')->nullable();
            $table->string('link')->nullable();
            $table->string('original_image')->nullable();
            $table->string('scaled_image')->nullable();
            $table->string('second_image')->nullable();
            $table->string('second_image_ratio')->nullable();
            $table->string('third_image')->nullable();
            $table->string('third_image_ratio')->nullable();
            $table->timestamps();

            $table->foreign('image_package_id')->references('id')->on('image_packages')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('image_ad_type_id')->references('id')->on('image_ad_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_ads');
    }
}
