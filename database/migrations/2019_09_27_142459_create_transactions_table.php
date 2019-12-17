<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('txn_orders')->onDelete('cascade');
            $table->string("MID");
            $table->string("TXNID");
            $table->string("TXNAMOUNT");
            $table->string("PAYMENTMODE");
            $table->string("CURRENCY");
            $table->string("TXNDATE");
            $table->string("STATUS");
            $table->string("RESPCODE");
            $table->string("RESPMSG");
            $table->string("GATEWAYNAME");
            $table->string("BANKNAME")->nullable();
            $table->string("CHECKSUMHASH");
            $table->string("BANKTXNID")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
