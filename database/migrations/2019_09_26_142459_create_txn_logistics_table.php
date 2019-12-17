<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnLogisticsTable extends Migration {

	public function up()
	{
		Schema::create('txn_logistics', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('password', 191)->nullable();
			$table->boolean('status')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('txn_logistics');
	}
}