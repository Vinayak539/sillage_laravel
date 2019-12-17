<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnContactUsTable extends Migration {

	public function up()
	{
		Schema::create('txn_contact_us', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100);
			$table->string('email', 100);
			$table->bigInteger('mobile');
			$table->string('subject', 100)->nullable();
			$table->string('message', 500)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('txn_contact_us');
	}
}