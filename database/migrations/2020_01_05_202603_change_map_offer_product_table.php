<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMapOfferProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('map_offer_products', function (Blueprint $table) {
            $table->integer('purchase_quantity')->after('map_offer_id')->nullable();
            $table->integer('offered_quantity')->after('purchase_quantity')->nullable();
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
