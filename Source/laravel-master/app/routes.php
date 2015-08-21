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

Route::get('/', function()
{
	return View::make('home');
});

/**
 *  Unauthenticated group
 *  User
 */

Route::group(array('before' => 'guest'), function(){

	Route::group(array('before' => 'csrf'), function(){

		//put all post related routes here for csrf filter
		Route::post('account/signup', 'UserController@postSignup');
		Route::post('account/signin', 'UserController@postSignin');

	});

	// login routes
	Route::get('/', 'UserController@getSignin');
	Route::get('account/signin', 'UserController@getSignin');
	
	// routes for account signup page
	Route::get('account/signup', 'UserController@getSignup');
	
});


/**
 *  Authenticated group
 *  User
 */

Route::group(array('before' => 'auth'), function(){

	Route::group(array('before' => 'csrf'), function(){

		// User profile
		Route::post('user/profile/{id}', 'UserController@postProfile');

	});
	
	Route::post('patient/add', array('as'=>'addPatient', 'uses'=>'PatientController@addPatient' ));

	Route::get('patient/create', array('as'=>'patient.create', 'uses'=>'PatientController@create'));
	
	Route::get('account/signout', array('as'=>'signout', 'uses'=>'UserController@getSignout'));

	// User profile
	Route::get('user/profile/{id}', array('as'=>'getProfile', 'uses'=>'UserController@getProfile'));

	// dashboard
	Route::get('dashboard','DashboardController@getDashboard');

});
Route::get('system',array('as' => 'system', 'uses' => 'SystemController@getparameters'));
