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

Route::get('bassengweb', array('as' => 'bassengweb', 'uses' => 'HomeController@getIndex'));
Route::post('bassengweb/login', array('uses' => 'HomeController@postLogin'));

Route::group(array('before' => 'auth'), function() //Protects these routes from users not logged in, redirects them to login if they attempt to bypass.
{
	Route::get('bassengweb/logout', array('as' => 'logout', 'uses' => 'HomeController@getLogout'));

	Route::get('bassengweb/timemaling', array('as' => 'timemaling', 'uses' => 'TimeMalingController@getTimeMaling'));
	Route::post('bassengweb/insertTM', array('uses' => 'TimeMalingController@postInsert'));

	Route::get('bassengweb/oppgaver', array('as' => 'oppgaver', 'uses' => 'OppgaverController@getOppgaver'));
	Route::post('bassengweb/insertOP', array('uses' => 'OppgaverController@postInsert'));

	Route::get('bassengweb/vannmaling', array('as' => 'vannmaling', 'uses' => 'VannMalingController@getVannMaling'));
	Route::post('bassengweb/insertVM', array('uses' => 'VannMalingController@postInsert'));

	Route::get('bassengweb/dagvakt', array('as' => 'dagvakt', 'uses' => 'DagVaktController@getDagvakt'));
	Route::post('bassengweb/insertDV', array('uses' => 'DagVaktController@postInsert'));

	Route::get('bassengweb/kveldsvakt', array('as' => 'kveldsvakt', 'uses' => 'KveldsVaktController@getKveldsvakt'));
	Route::post('bassengweb/insertKV', array('uses' => 'KveldsVaktController@postInsert'));

	Route::get('bassengweb/helgevakt', array('as' => 'helgevakt', 'uses' => 'HelgeVaktController@getHelgeVakt'));
	Route::post('bassengweb/insertHV', array('uses' => 'HelgeVaktController@postInsert'));

	Route::get('bassengweb/kontrollcm', array('as' => 'kontrollcm', 'uses' => 'KontrollCmController@getKontrollCM'));
	Route::post('bassengweb/insertKCM', array('uses' => 'KontrollCmController@postInsert'));

	Route::get('bassengweb/sok', array('as' => 'sok', 'uses' => 'SokController@getSok'));
	Route::get('bassengweb/data', array('uses' => 'SokController@getData'));

	Route::get('bassengweb/users', array('as' => 'user_data', 'uses' => 'HomeController@getUserData'));

	Route::group(array('before' => 'admin'), function() //Protects the inner functions from users that are not admins.
	{
		Route::get('bassengweb/{id}/editData', array('as' => 'edit_data', 'uses' => 'AdminController@getUpdatePage'));
		Route::put('bassengweb/updateData', array('uses' => 'AdminController@putUpdateData'));

		Route::get('bassengweb/{id}/delete_confirmation', array('as' => 'delete_confirm', 'uses' => 'AdminController@getDeletePage'));
		Route::delete('bassengweb/deleteData', array('uses' => 'AdminController@deleteDestroyData'));
		
		Route::get('bassengweb/edit_user', array('as' => 'edit_user', 'uses' => 'AdminController@getUserUpdatePage'));
		Route::put('bassengweb/update_user', array('uses' => 'AdminController@putUpdateUser'));

		Route::get('bassengweb/create_user', array('as' => 'create_user', 'uses' => 'AdminController@getUserCreatePage'));
		Route::post('bassengweb/spawn_user', array('uses' => 'AdminController@postCreateUser'));

		Route::put('bassengweb/ressurect_user', array('uses' => 'AdminController@putActivateUser'));
		Route::get('bassengweb/delete_user', array('as' => 'delete_user', 'uses' => 'AdminController@getUserDeletePage'));
		Route::delete('bassengweb/purge_user', array('uses' => 'AdminController@deleteDestroyUser'));

		Route::get('bassengweb/change_log', array('as' => 'change_log', 'uses' => 'AdminController@getChangeLogPage'));
		Route::get('bassengweb/chlog', array('uses' => 'AdminController@getChlogSpecific'));
	});
});