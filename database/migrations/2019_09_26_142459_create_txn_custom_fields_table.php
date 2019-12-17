<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnCustomFieldsTable extends Migration {

	public function up()
	{
		Schema::create('txn_custom_fields', function(Blueprint $table) {
			$table->increments('id');
			$table->string('field_name', 100)->nullable();
			$table->string('field_value', 100)->nullable();
			$table->integer('product_id')->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('txn_custom_fields');
	}
}