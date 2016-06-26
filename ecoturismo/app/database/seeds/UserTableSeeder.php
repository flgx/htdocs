<?php

use Backoffice\Entities\User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		User::create([
			"id"				=> 4, 
			"first_name"		=> "Root",
			"last_name"			=> "Sistema",
			"email"				=> "admin@natarg.com.ar",
			"password" 			=> 'NatArg2016',
			"enabled" 			=> 1,
			"role_id" 			=> 1,
			"user_created_id" 	=> 4
		]);	
	}

}