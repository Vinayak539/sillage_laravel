<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('txn_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('parent_id')->unsigned();
			$table->string('name', 191);
			$table->string('slug_url', 191);
			$table->boolean('status')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('txn_categories');
	}
}