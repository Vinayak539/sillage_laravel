<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnShippingsTable extends Migration {

	public function up()
	{
		Schema::create('txn_shippings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('website_url')->nullable();
			$table->string('image_url')->nullable();
			$table->boolean('status')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('txn_shippings');
	}
}