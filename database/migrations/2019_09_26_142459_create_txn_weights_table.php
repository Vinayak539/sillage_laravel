<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnWeightsTable extends Migration {

	public function up()
	{
		Schema::create('txn_weights', function(Blueprint $table) {
			$table->increments('id');
			$table->string('unit', 10);
			$table->boolean('status')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('txn_weights');
	}
}