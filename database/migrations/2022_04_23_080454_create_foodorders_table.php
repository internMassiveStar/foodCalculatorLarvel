<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foodorders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id');
            $table->string('order_name');
            $table->string('order_mobile');
            $table->string('waiter');
            $table->string('table');
            $table->string('order_item');
            $table->string('total_price');
            $table->string('vat');
            $table->string('grand_price');
            $table->string('kitchen_status')->default(0);
            $table->string('price_status')->default(0);
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
        Schema::dropIfExists('foodorders');
    }
}
