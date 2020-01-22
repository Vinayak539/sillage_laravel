<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('txn_users')->onDelete('restrict');
            $table->string('address', 255)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('territory', 50)->nullable();
            $table->integer('pincode')->nullable();
            $table->string('landmark', 50)->nullable();
            $table->string('country')->nullable();
            $table->string('type_of_address')->nullable();
            $table->string('name')->nullable();
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
        Schema::dropIfExists('addresses');
    }
}
