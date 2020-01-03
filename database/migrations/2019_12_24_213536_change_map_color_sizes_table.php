<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMapColorSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('map_color_sizes', function (Blueprint $table) {
            $table->integer('gst')->default('0')->nullable();
            $table->float('starting_price')->nullable();
            $table->float('buy_it_now_price')->nullable();
            $table->float('discount_price')->default('0')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('map_color_sizes', function (Blueprint $table) {
            //
        });
    }
}
