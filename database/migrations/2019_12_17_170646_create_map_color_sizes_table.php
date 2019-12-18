<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapColorSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_color_sizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('txn_products')->onDelete('restrict');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('mst_colors')->onDelete('restrict');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->references('id')->on('mst_sizes')->onDelete('restrict');
            $table->double('mrp');
            $table->integer('stock');
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
        Schema::dropIfExists('map_color_sizes');
    }
}
