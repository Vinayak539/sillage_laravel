<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMapProductSectionsTable extends Migration {

	public function up()
	{
		Schema::create('map_product_sections', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('section_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('map_product_sections');
	}
}