<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMapOffersProductsChangeConstrainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('map_offer_products', function (Blueprint $table) {
            $table->unsignedBigInteger('mst_offer_id')->nullable()->after('product_id');
            $table->foreign('mst_offer_id')->references('id')->on('mst_offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('map_offer_products', function (Blueprint $table) {
            //
        });
    }
}
