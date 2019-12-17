<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnOrderDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('txn_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('quantity')->nullable();
            $table->float('mrp')->nullable();
            $table->float('purchasing_price')->nullable();
            $table->float('packing_price')->nullable();
            $table->float('other_charges')->nullable();
            $table->float('shipping_charges')->nullable();
            $table->double('total')->nullable();
            $table->string('pnl')->nullable();
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
