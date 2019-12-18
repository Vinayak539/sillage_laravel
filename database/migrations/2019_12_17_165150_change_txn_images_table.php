<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTxnImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('txn_images', function (Blueprint $table) {
            $table->unsignedBigInteger('color_id')->nullable()->after('product_id');
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
        Schema::table('txn_images', function (Blueprint $table) {
            //
        });
    }
}
