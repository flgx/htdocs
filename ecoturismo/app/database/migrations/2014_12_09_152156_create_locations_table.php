<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',250);
			$table->text('description');			
			$table->string('image',100)->nullable();		
			$table->double('lat', 10, 6);
			$table->double('lng', 10, 6);		
			$table->integer('views')->unsigned()->default(0);
			$table->integer('ranking')->unsigned()->default(0);
			$table->boolean('enabled')->default(1);

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
