<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('location_tag', function(Blueprint $table)
		{
			$table->integer('location_id')->unsigned();
			$table->integer('tag_id')->unsigned();

			$table->foreign('tag_id')->references('id')->on('tags');
			$table->foreign('location_id')->references('id')->on('locations');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

	}

}
