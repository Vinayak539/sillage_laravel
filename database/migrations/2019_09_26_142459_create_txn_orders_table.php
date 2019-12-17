<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('txn_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('message')->nullable();
            $table->double('tbt')->nullable();
            $table->double('tax')->nullable();
            $table->double('total')->nullable();
            $table->double('discount')->nullable();
            $table->string('payment_mode', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->string('payment_status', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('territory', 50)->nullable();
            $table->integer('pincode')->nullable();
            $table->string('landmark', 50)->nullable();
            $table->string('country')->nullable();
            $table->string('district')->nullable();
            $table->string('to_lable', 255)->nullable();
            $table->string('from_lable', 255)->nullable();
            $table->integer('shipping_id')->unsigned()->nullable();
            $table->string('awf_number', 255)->nullable();
            $table->date('delivery_date')->nullable();
            $table->text('remark')->nullable();
            $table->string('user_name')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->text('other_reason')->nullable();
            $table->string('image_url')->nullable();
            $table->bigInteger('reward_points')->nullable();
            $table->string('return_status')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('txn_orders');
    }
}
