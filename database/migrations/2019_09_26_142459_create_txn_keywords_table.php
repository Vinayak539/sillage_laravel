<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnKeywordsTable extends Migration {

	public function up()
	{
		Schema::create('txn_keywords', function(Blueprint $table) {
			$table->increments('id');
			$table->string('keyword', 50);
			$table->integer('product_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('txn_keywords');
	}
}