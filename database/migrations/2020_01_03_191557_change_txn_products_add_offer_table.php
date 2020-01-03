<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTxnProductsAddOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('txn_products', function (Blueprint $table) {
            $table->string('purchase_qty')->nullable()->after('quality_issue');
            $table->string('offered_qty')->nullable()->after('purchase_qty');
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
