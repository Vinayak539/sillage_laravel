<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapOfferProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_offer_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('txn_products')->onDelete('cascade');
            $table->unsignedBigInteger('map_offer_id')->nullable();
            $table->foreign('map_offer_id')->references('id')->on('map_mst_offer_products')->onDelete('cascade');
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
        Schema::dropIfExists('map_offer_products');
    }
}
