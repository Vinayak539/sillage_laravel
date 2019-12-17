<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxnImagesTable extends Migration {

	public function up()
	{
		Schema::create('txn_images', function(Blueprint $table) {
			$table->increments('id');
			$table->string('image_url', 191);
			$table->integer('product_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('txn_images');
	}
}