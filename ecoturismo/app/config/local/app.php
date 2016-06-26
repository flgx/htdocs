<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => true,

	/*
	|--------------------------------------------------------------------------
	| Image Config
	|--------------------------------------------------------------------------
	|
	| Image Config
	|
	*/

	'image' => array(

		/**
		 * CDN Domain
		 */
		'cdn' => array(
		    "local.natarg.com" => "css|js|eot|woff|ttf",
		    "local.natarg.com" => "jpg|jpeg|png|gif|svg",
		    "local.natarg.com" => "",
		),

		/**
		 * Product image path server
		 */                       
		'location-path-server' => '/Library/WebServer/Documents/Projects/local.natarg.com/public/assets/images/location',

		/**
		 * Product image path server
		 */
		'avatar-path-server' => '/Library/WebServer/Documents/Projects/local.natarg.com/public/assets/images/avatar/',
	),
);
