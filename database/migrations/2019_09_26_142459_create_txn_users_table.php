<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnUsersTable extends Migration
{

    public function up()
    {
        Schema::create('txn_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('otp', 10)->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('password')->nullable();
            $table->string('coupon', 50)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('city', 20)->nullable();
            $table->string('territory', 20)->nullable();
            $table->integer('pincode')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('first_purchase')->nullable();
            $table->timestamp('last_purchase')->nullable();
            $table->string('gst', 20)->nullable();
            $table->boolean('is_subcribed')->default(true);
            $table->boolean('status')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->string('country')->nullable();
            $table->string('district')->nullable();
            $table->string('landmark')->nullable();
            $table->bigInteger('total_rewards')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('image_url')->nullable();
            $table->char('promocode', 12)->nullable()->unique();
            $table->date('date_of_birth')->nullable();
            $table->text('company_name')->nullable();
            $table->date('sales_start_date')->nullable();
            $table->date('sales_end_date')->nullable();
            $table->string('total_sales')->nullable();
            $table->boolean('elite')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('txn_users');
    }
}
