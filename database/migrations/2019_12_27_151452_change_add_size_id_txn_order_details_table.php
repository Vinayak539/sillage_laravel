<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAddSizeIdTxnOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('txn_order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('size_id')->nullable()->after('order_id');
            $table->foreign('size_id')->references('id')->on('mst_sizes')->onDelete('restrict');
            $table->unsignedBigInteger('color_id')->nullable()->after('order_id');
            $table->foreign('color_id')->references('id')->on('mst_colors')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('txn_order_details', function (Blueprint $table) {
            //
        });
    }
}
