<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMsSectionsTable extends Migration {

	public function up()
	{
		Schema::create('ms_sections', function(Blueprint $table) {
			$table->increments('id');
			$table->string('SectionName', 20);
			$table->boolean('status')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('ms_sections');
	}
}