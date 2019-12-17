<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnConditionsTable extends Migration {

	public function up()
	{
		Schema::create('txn_conditions', function(Blueprint $table) {
			$table->increments('id');
			$table->string('condition', 50);
			$table->boolean('status')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('txn_conditions');
	}
}