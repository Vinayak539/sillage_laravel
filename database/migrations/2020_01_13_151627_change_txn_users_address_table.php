<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTxnUsersAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('txn_users', function (Blueprint $table) {
            $table->unsignedBigInteger('address_id')->nullable()->after('pincode');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('txn_users', function (Blueprint $table) {
            //
        });
    }
}
