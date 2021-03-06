<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// admin routes 

Route::get('/admin/', 'AdminController@login');
Route::post('/admin/authorize', 'AdminController@authorize');


// all pages in this group require admin login
Route::group(['middleware' => ['auth']], function(){

	Route::get('/admin/cocktails', 'AdminController@index');
	Route::get('/admin/ingredients', 'AdminController@getIngredients');
	Route::get('/admin/ingredient_categories', 'AdminController@getIngredientTypes');
	Route::get('/admin/drink/new', 'AdminController@addDrink');
	Route::post('/admin/drink/add', 'AdminController@createDrink');
	Route::post('/admin/ingredient_type/add', 'AdminController@saveIngredientType');


	Route::get('/admin/drink/{id}', 'AdminController@getDrinkDetail');
	Route::get('/admin/drink/{id}/edit', 'AdminController@editDrink');
	Route::get('/get-ingredients/{name}', 'AdminController@getIngredientsAjax');

});

Route::get('/auth/login', function(){

	return redirect('/admin/');

});

Route::get('/{id?}','DrinksController@search');

Route::get('/register',"PagesController@register");

Route::get('/drink/{slug}','DrinksController@getDrink')->where(['slug'=>'[a-z-]+']);

Route::get('/drink/{id}', 'DrinksController@getDrinkById')->where(['id'=>'[0-9]+']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('logout',function(){

	Auth::logout();
	redirect('/');

});