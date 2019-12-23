<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTxnReviewsTable extends Migration
{

    public function up()
    {
        Schema::create('txn_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned();
            $table->string('comment', 500)->nullable();
            $table->enum('rating', array('1', '2', '3', '4', '5'));
            $table->string('feedback_url')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('txn_reviews');
    }
}
