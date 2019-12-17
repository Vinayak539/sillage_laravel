<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnMaterialsTable extends Migration {

	public function up()
	{
		Schema::create('txn_materials', function(Blueprint $table) {
			$table->increments('id');
			$table->string('material_name', 191);
			$table->boolean('status')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('txn_materials');
	}
}