<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnOrderDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('txn_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('txn_products')->onDelete('restrict');
            $table->unsignedBigInteger('map_id');
            $table->foreign('map_id')->references('id')->on('map_color_sizes')->onDelete('restrict');
            $table->integer('quantity')->nullable();
            $table->float('mrp')->nullable();
            $table->unsignedInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('txn_orders')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('txn_order_details');
    }
}
