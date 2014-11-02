<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//create
		Schema::create('books',function($table){
			#the primary key
			$table->increments('id');
			$table->timestamps();
			#the rest of fields
			$table->string('title');
			$table->string('author');
			$table->integer('published');
			$table->string('cover');
			$table->string('purchase_link');

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('books');
	}

}
