<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductFAQSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_faqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('question');
            $table->text('answer');
            $table->string('replied_by')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('txn_products')->onDelete('restrict');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('product_f_a_q_s');
    }
}
