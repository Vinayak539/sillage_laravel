<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTxnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('txn_products', function (Blueprint $table) {
            $table->string('image_url1')->nullable()->after('image_url');
            $table->unsignedBigInteger('gst_id')->nullable()->after('brand_id');
            $table->foreign('gst_id')->references('id')->on('txn_master_gsts')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('txn_products', function (Blueprint $table) {
            //
        });
    }
}
