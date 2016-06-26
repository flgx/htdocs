<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_tag_id')->unsigned()->nullable();
			$table->string('name',250);		
			$table->integer('locations_quantity')->unsigned()->default(0);		
			$table->string('icon',200)->nullable();			
			$table->string('marker',200)->nullable();				

			$table->integer('user_created_id')->unsigned()->nullable();
			$table->integer('user_updated_id')->unsigned()->nullable();
			
			$table->dateTime('created_at');
			$table->dateTime('updated_at')->nullable();	
			$table->dateTime('deleted_at')->nullable();
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
	}

}
