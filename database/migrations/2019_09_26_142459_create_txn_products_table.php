<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnProductsTable extends Migration
{

    public function up()
    {
        Schema::create('txn_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 191);
            $table->integer('category_id')->unsigned()->nullable();
            $table->bigInteger('upc')->nullable();
            $table->integer('brand_id')->unsigned()->nullable();
            $table->integer('material_id')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->float('length')->nullable();
            $table->float('breadth')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->integer('weight_unit')->unsigned()->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('condition_id')->unsigned()->nullable();
            $table->string('image_url')->nullable();
            $table->string('slug_url')->nullable();
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('warranty_id')->nullable();
            $table->foreign('warranty_id')->references('id')->on('master_warranties')->onDelete('restrict');
            $table->string('width')->nullable();
            $table->boolean('isCodAvailable')->nullable();
            $table->boolean('within_days')->default(false)->nullable();
            $table->boolean('wrong_products')->default(false)->nullable();
            $table->boolean('faulty_products')->default(false)->nullable();
            $table->boolean('quality_issue')->default(false)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('txn_products');
    }
}
