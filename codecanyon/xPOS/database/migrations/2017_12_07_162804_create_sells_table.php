<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outlet_id');
            $table->string('ref_number');
            $table->integer('status')->default(0);
            $table->integer('order_type');
            $table->double('vat')->default(0);
            $table->double('discount')->default(0);
            $table->double('sell_value')->default(0);
            $table->double('sell_charges')->default(0);
            $table->integer('customer_id')->default(0);
            $table->integer('user_id');
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
        Schema::dropIfExists('sells');
    }
}
