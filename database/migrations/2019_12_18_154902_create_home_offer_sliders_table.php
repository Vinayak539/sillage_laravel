<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeOfferSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_offer_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_url');
            $table->string('title')->nullable();
            $table->integer('sort_index')->nullable();
            $table->string('url')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_offer_sliders');
    }
}
