<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Varients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('varients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('variant_id')->nullable();
            $table->text('title')->nullable();
            $table->text('option1')->nullable();
            $table->text('option2')->nullable();
            $table->text('option3')->nullable();
            $table->text('sku')->nullable();
            $table->boolean('requires_shipping')->nullable();
            $table->text('fulfillment_service')->nullable();
            $table->text('taxable')->nullable();
            $table->text('image')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('compare_at_price')->nullable();
            $table->text('weight')->nullable();
            $table->text('grams')->nullable();
            $table->text('weight_unit')->nullable();
            $table->bigInteger('inventory_item_id')->nullable();
            $table->bigInteger('inventory_quantity')->nullable();
            $table->text('inventory_management')->nullable();
            $table->text('inventory_policy')->nullable();
            $table->text('barcode')->nullable();
            $table->bigInteger('shopify_product_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('shop_id')->nullable();
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
        //
    }
}
