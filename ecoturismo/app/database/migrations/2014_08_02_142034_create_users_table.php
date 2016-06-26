<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id')->unsigned();
			$table->string('facebook_id',50);
			$table->string('first_name',50);
			$table->string('last_name',50);
			$table->string('image',100)->nullable();
			$table->text('about_me')->nullable();
			$table->string('email')->unique();
			$table->string('password',100)->nullable();
			$table->boolean('enabled')->default(1);

			$table->rememberToken();
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
