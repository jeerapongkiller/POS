<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_websites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outlet_id');
            $table->string('banner_img');
            $table->string('title_one');
            $table->double('title_one_size');
            $table->string('title_one_color');
            $table->string('title_two');
            $table->double('title_two_size');
            $table->string('title_two_color');
            $table->text('text');
            $table->double('text_size');
            $table->string('text_color');
            $table->string('card_color');
            $table->string('card_color_hover');
            $table->string('price_color');
            $table->string('price_color_hover');
            $table->double('price_size');
            $table->string('product_title_color');
            $table->string('product_title_color_hover');
            $table->double('product_title_size');
            $table->double('image_height');
            $table->double('image_width');
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
        Schema::dropIfExists('outlet_websites');
    }
}
