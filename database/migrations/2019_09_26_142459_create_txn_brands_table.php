<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnBrandsTable extends Migration {

	public function up()
	{
		Schema::create('txn_brands', function(Blueprint $table) {
			$table->increments('id');
			$table->string('brand_name', 191);
			$table->boolean('status')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('txn_brands');
	}
}