<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sell_id');
            $table->integer('payment_type')->default(1);
            $table->string('payment_info')->nullable();
            $table->double('cash_journal');
            $table->double('change');
            $table->double('payment');
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
        Schema::dropIfExists('sell_payments');
    }
}
