<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shopify_id')->nullable();
            $table->text('order_number')->nullable();
            $table->text('note')->nullable();
            $table->text('date')->nullable();
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
            $table->text('currency')->nullable();
            $table->text('total_price')->nullable();
            $table->text('financial_status')->nullable();
            $table->text('fulfillment_status')->nullable();
            $table->text('customer_phone')->nullable();
            $table->bigInteger('shop_id')->nullable();
            $table->bigInteger('total_discount')->nullable();
            $table->bigInteger('sub_total')->nullable();
            $table->bigInteger('total_shipping')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
