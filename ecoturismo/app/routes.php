<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//CONTACT
Route::post('contact_request','ContactController@getContactUsForm');
//LANDING
Route::get('/', ['as'=>'app.index', 'uses'=>'AppController@index']);
Route::get('/{id}/children-tag', ['as'=>'app.chldren-tag', 'uses'=>'AppController@getChildrenTags']);
Route::get('/{id}/children-location', ['as'=>'app.chldren-location', 'uses'=>'AppController@getChildrenLocation']);
Route::get('/{id}/location-info', ['as'=>'app.location', 'uses'=>'AppController@getLocationInfo']);
Route::post('/login', ['as'=>'app.login', 'uses'=>'AppController@login']);
Route::post('/location/{id}/destroyImage', ['as'=>'location.destroyImage', 'uses'=>'LocationController@destroyImage']);

Route::get('/login-facebook', ['as'=>'app.login.facebook', 'uses'=>'AuthController@loginWithFacebook']);
Route::post('/register', ['as'=>'app.register', 'uses'=>'AppController@register']);
Route::get('/logout', ['as'=>'app.logout', 'uses'=>'AppController@logout']);

//REMINDER
Route::get('/password/reset/{token}', 	['as'=>'app.password.show.reset', 'uses'=>'AppController@index']);
Route::post('/reminder/reset', 			['as'=>'app.reminder.reset', 	  'uses'=>'AppController@postReset']);
Route::post('/reminder', 				['as'=>'app.reminder.sent',  	  'uses'=>'AppController@postRemind']);


Route::group(['before' => 'guest', 'prefix' => 'admin'], function () {

	//AUTH
    Route::get('/login',  ['as'=>'login.show', 'uses'=>'AuthController@show']);
    Route::post('/login', ['as'=>'login', 	   'uses'=>'AuthController@login']);

    //REMINDER
    Route::get('/reminder', ['as'=>'reminder', 'uses'=>'RemindersController@getRemind']);
    Route::get('/password/reset/{token}', 	['as'=>'password.show.reset', 'uses'=>'RemindersController@getReset']);
    Route::post('/reminder/reset', 			['as'=>'reminder.reset', 	  'uses'=>'RemindersController@postReset']);
    Route::post('/reminder', 				['as'=>'reminder.sent',  	  'uses'=>'RemindersController@postRemind']);
});

Route::group(['before'=>'auth'], function() {
	Route::post('/ranking', ['as'=>'ranking', 'uses'=>'AppController@ranking']);
	Route::post('/comment', ['as'=>'comment', 'uses'=>'AppController@comment']);
	Route::post('/edit-profile', ['as'=>'edit-profile', 'uses'=>'ProfileController@editUser']);
});

Route::group(['before' => 'auth', 'prefix' => 'admin'], function()
{
	//AUTH
	Route::get('/logout', ['as'=>'logout', 	   'uses'=>'AuthController@logout']);
	
	//DASHBOARD
	Route::get('/', 		 ['as'=>'dashboard.init', 'uses'=>'DashboardController@index']);
	Route::get('/dashboard', ['as'=>'dashboard', 'uses'=>'DashboardController@index']);

	//PROFILE
	Route::get('/profile', 	['as'=>'profile',   	 'uses'=>'ProfileController@index']);
	Route::put('/profile/', ['as'=>'profile.update', 'uses'=>'ProfileController@update']);

	//USER
	if(BackofficeResource::can('usuarios', 'read')) {
		Route::get('/user',		 ['as'=>'user',      'uses'=>'UserController@index']);
		Route::get('/user/list', ['as'=>'user.list', 'uses'=>'UserController@lists']);
	}

	if(BackofficeResource::can('usuarios', 'create')) {
		Route::get('/user/create', ['as'=>'user.create', 'uses'=>'UserController@create']);
		Route::post('/user',  	   ['as'=>'user.store',  'uses'=>'UserController@store']);
	}

	if(BackofficeResource::can('usuarios', 'update')) {
		Route::get('/user/{id}/edit', ['as'=>'user.edit',	 'uses'=>'UserController@edit']);
		Route::put('/user/{id}',      ['as'=>'user.update', 'uses'=>'UserController@update']);
	}

	if(BackofficeResource::can('usuarios', 'destroy')) {
		Route::get('/user/{id}/destroy', ['as'=>'user.destroy', 'uses'=>'UserController@destroy']);
	}

	//ROLE
	if(BackofficeResource::can('roles', 'read')) {
		Route::get('/role',		 ['as'=>'role',      'uses'=>'RoleController@index']);
		Route::get('/role/list', ['as'=>'role.list', 'uses'=>'RoleController@lists']);
	}

	if(BackofficeResource::can('roles', 'create')) {
		Route::get('/role/create', ['as'=>'role.create', 'uses'=>'RoleController@create']);
		Route::post('/role',  	   ['as'=>'role.store',  'uses'=>'RoleController@store']);
	}

	if(BackofficeResource::can('roles', 'update')) {
		Route::get('/role/{id}/edit', ['as'=>'role.edit',	 'uses'=>'RoleController@edit']);
		Route::put('/role/{id}',      ['as'=>'role.update', 'uses'=>'RoleController@update']);
	}

	if(BackofficeResource::can('roles', 'destroy')) {
		Route::get('/role/{id}/destroy', ['as'=>'role.destroy', 'uses'=>'RoleController@destroy']);
	}

	if(BackofficeResource::can('roles', 'create') || BackofficeResource::can('roles', 'update')) {
		Route::get('/role/{id}/resources', ['as'=>'role.resoures', 'uses'=>'RoleController@toCheck']);
	}

	//RESOURCE
	if(BackofficeResource::isRoot()) {
		//READ
		Route::get('/resource',		 ['as'=>'resource',      'uses'=>'ResourceController@index']);
		Route::get('/resource/list',  ['as'=>'resource.list', 'uses'=>'ResourceController@lists']);
	
		//CREATE
		Route::get('/resource/create', ['as'=>'resource.create', 'uses'=>'ResourceController@create']);
		Route::post('/resource',  	  ['as'=>'resource.store',  'uses'=>'ResourceController@store']);
		
		//UPDATE
		Route::get('/resource/{id}/edit', ['as'=>'resource.edit',   'uses'=>'ResourceController@edit']);
		Route::put('/resource/{id}',      ['as'=>'resource.update', 'uses'=>'ResourceController@update']);
		
		//DESTROY
		Route::get('/resource/{id}/destroy', ['as'=>'resource.destroy', 'uses'=>'ResourceController@destroy']);
	}

	//TAGS
	if(BackofficeResource::can('tags', 'read')) {
		Route::get('/tag',		 ['as'=>'tag',      'uses'=>'TagController@index']);
		Route::get('/tag/list', ['as'=>'tag.list', 'uses'=>'TagController@lists']);
	}

	if(BackofficeResource::can('tags', 'create')) {
		Route::get('/tag/create', ['as'=>'tag.create', 'uses'=>'TagController@create']);
		Route::post('/tag',  	   ['as'=>'tag.store',  'uses'=>'TagController@store']);
	}

	if(BackofficeResource::can('tags', 'update')) {
		Route::get('/tag/{id}/edit', ['as'=>'tag.edit',	 'uses'=>'TagController@edit']);
		Route::put('/tag/{id}',      ['as'=>'tag.update', 'uses'=>'TagController@update']);
	}

	if(BackofficeResource::can('tags', 'destroy')) {
		Route::get('/tag/{id}/destroy', ['as'=>'tag.destroy', 'uses'=>'TagController@destroy']);
	}

	//LOCATIONS
	if(BackofficeResource::can('locaciones', 'read')) {
		Route::get('/location',		 ['as'=>'location',      'uses'=>'LocationController@index']);
		Route::get('/location/list', ['as'=>'location.list', 'uses'=>'LocationController@lists']);
	}

	if(BackofficeResource::can('locaciones', 'create')) {
		Route::get('/location/create', ['as'=>'location.create', 'uses'=>'LocationController@create']);
		Route::post('/location',  	   ['as'=>'location.store',  'uses'=>'LocationController@store']);
	}

	if(BackofficeResource::can('locaciones', 'update')) {
		Route::get('/location/{id}/edit', ['as'=>'location.edit',	 'uses'=>'LocationController@edit']);
		Route::put('/location/{id}',      ['as'=>'location.update', 'uses'=>'LocationController@update']);
	}

	if(BackofficeResource::can('locaciones', 'destroy')) {
		Route::get('/location/{id}/destroy', ['as'=>'location.destroy', 'uses'=>'LocationController@destroy']);
	}
	if(BackofficeResource::can('locaciones', 'destroy')) {
		Route::get('/location/{id}/destroyImage', ['as'=>'location.destroyImage', 'uses'=>'LocationController@destroyImage']);
	}

	//COMMENTS
	if(BackofficeResource::can('comentarios', 'read')) {
		Route::get('/comment',		 ['as'=>'comments.admin',      'uses'=>'CommentController@index']);
		Route::get('/comment/list', ['as'=>'comments.list', 'uses'=>'CommentController@lists']);
		Route::post('/comment/{id}/block', ['as'=>'comments.block', 'uses'=>'CommentController@block']);
		Route::post('/comment/{id}/unblock', ['as'=>'comments.unblock', 'uses'=>'CommentController@unblock']);
		Route::get('/badword', ['as'=>'badword', 'uses'=>'BadWordsController@index']);
		Route::put('/badword', ['as'=>'badword.update', 'uses'=>'BadWordsController@update']);
	}

	//REPORTS
	if(BackofficeResource::can('reportes', 'read')) {
		Route::get('/report', 			['as'=>'report', 		  'uses'=>'ReportController@index']);
		Route::post('/report/generate', ['as'=>'report.generate', 'uses'=>'ReportController@generate']);
	}
});

