<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		
		Schema::table('txn_products', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('txn_categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});

		Schema::table('txn_products', function(Blueprint $table) {
			$table->foreign('brand_id')->references('id')->on('txn_brands')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		
		Schema::table('txn_products', function(Blueprint $table) {
			$table->foreign('material_id')->references('id')->on('txn_materials')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('txn_products', function(Blueprint $table) {
			$table->foreign('weight_unit')->references('id')->on('txn_weights')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('txn_products', function(Blueprint $table) {
			$table->foreign('condition_id')->references('id')->on('txn_conditions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('txn_images', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('txn_products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		
		Schema::table('txn_keywords', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('txn_products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});

		Schema::table('txn_custom_fields', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('txn_products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		
		Schema::table('txn_orders', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('txn_users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('txn_orders', function(Blueprint $table) {
			$table->foreign('shipping_id')->references('id')->on('txn_shippings')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('txn_reviews', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('txn_users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('txn_reviews', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('txn_products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('txn_order_details', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('txn_products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		
		Schema::table('map_product_sections', function(Blueprint $table) {
			$table->foreign('section_id')->references('id')->on('ms_sections')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('map_product_sections', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('txn_products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		
	}

	public function down()
	{
		Schema::table('txn_categories', function(Blueprint $table) {
			$table->dropForeign('txn_categories_parent_id_foreign');
		});
		Schema::table('txn_products', function(Blueprint $table) {
			$table->dropForeign('txn_products_category_id_foreign');
		});
		Schema::table('txn_products', function(Blueprint $table) {
			$table->dropForeign('txn_products_brand_id_foreign');
		});
		
		Schema::table('txn_products', function(Blueprint $table) {
			$table->dropForeign('txn_products_material_id_foreign');
		});
		Schema::table('txn_products', function(Blueprint $table) {
			$table->dropForeign('txn_products_weight_unit_foreign');
		});
		Schema::table('txn_products', function(Blueprint $table) {
			$table->dropForeign('txn_products_condition_id_foreign');
		});
		Schema::table('txn_images', function(Blueprint $table) {
			$table->dropForeign('txn_images_product_id_foreign');
		});
		Schema::table('txn_keywords', function(Blueprint $table) {
			$table->dropForeign('txn_keywords_product_id_foreign');
		});
		Schema::table('txn_custom_fields', function(Blueprint $table) {
			$table->dropForeign('txn_custom_fields_product_id_foreign');
		});
		Schema::table('txn_orders', function(Blueprint $table) {
			$table->dropForeign('txn_orders_product_id_foreign');
		});
		Schema::table('txn_orders', function(Blueprint $table) {
			$table->dropForeign('txn_orders_user_id_foreign');
		});
		Schema::table('txn_orders', function(Blueprint $table) {
			$table->dropForeign('txn_orders_shipping_id_foreign');
		});
		Schema::table('txn_reviews', function(Blueprint $table) {
			$table->dropForeign('txn_reviews_user_id_foreign');
		});
		Schema::table('txn_reviews', function(Blueprint $table) {
			$table->dropForeign('txn_reviews_product_id_foreign');
		});
		Schema::table('txn_order_details', function(Blueprint $table) {
			$table->dropForeign('txn_order_details_product_id_foreign');
		});
		Schema::table('map_product_sections', function(Blueprint $table) {
			$table->dropForeign('map_product_sections_section_id_foreign');
		});
		Schema::table('map_product_sections', function(Blueprint $table) {
			$table->dropForeign('map_product_sections_product_id_foreign');
		});
	}
}