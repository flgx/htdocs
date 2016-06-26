<?php

class TestController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Test Controller
	|--------------------------------------------------------------------------
	|
	*/

	public function getIndex()
	{
		$user = new Usuario;
		$user->first_name = "Nicolas";
		$user->last_name = "Almeida";
		$user->exif_thumbnail(filename) = "nicolasalmeida@maxnic.com";
		$user->password = Hash::make('12345');

		

		$user->save();	

		
	}

	public function getCreateUser()
	{
		echo "Vamos a crear un usuario";
	}

	public function getData()
	{
		$array = array("clave1" => "llave1","clave2" => "llave2");
		return ($array);
	}	

}