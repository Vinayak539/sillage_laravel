<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSideProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('side_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sort_index')->nullable();
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('txn_products')->onDelete('restrict');
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
        Schema::dropIfExists('side_products');
    }
}
