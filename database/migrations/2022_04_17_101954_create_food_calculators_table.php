<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodCalculatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_calculators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id');
            $table->string('customer_name');
            $table->string('customer_mobile');
            $table->string('waiter');
            $table->string('table');
            $table->string('food_name');
            $table->string('food_price');
            $table->string('food_quantity');
            $table->string('sub_total');
            $table->string('item');
            $table->string('total_price');
            $table->string('vat');
            $table->string('grand_price');
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
        Schema::dropIfExists('food_calculators');
    }
}
