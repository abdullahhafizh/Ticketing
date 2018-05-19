<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@index');
Route::post('reservasi/create', 'GuestController@reservasi_create');
Route::post('search','GuestController@search');
Route::post('pesan','GuestController@pesan');
Route::get('new/pesan/{id}','GuestController@newpesan');
Route::get('success', 'GuestController@success');

Route::group(['prefix' => 'customer'] , function(){
	Route::get('/', 'CustomerController@index');	
	Route::post('create', 'CustomerController@store');
	Route::get('{id}/show', 'CustomerController@show');
	Route::post('{id}/edit', 'CustomerController@edit');
	Route::post('{id}/update', 'CustomerController@update');
	Route::post('{id}/destroy', 'CustomerController@destroy');
	Route::post('export', 'CustomerController@export');
});

Route::group(['prefix' => 'users'] , function(){
	Route::get('/', 'UserController@index');
	Route::post('{id}/edit', 'UserController@edit');
	Route::get('{id}/edit', 'UserController@edit');
	Route::post('{id}/update', 'UserController@update');
	Route::post('{id}/destroy', 'UserController@destroy');
	Route::post('export', 'UserController@export');
});

Route::group(['prefix' => 'transportation_type'] , function(){
	Route::get('/', 'TransportationTypeController@index');	
	Route::post('create', 'TransportationTypeController@store');
	Route::get('{id}/show', 'TransportationTypeController@show');
	Route::post('{id}/edit', 'TransportationTypeController@edit');
	Route::post('{id}/update', 'TransportationTypeController@update');
	Route::post('{id}/destroy', 'TransportationTypeController@destroy');
	Route::post('export', 'TransportationTypeController@export');

});

Route::group(['prefix' => 'transportation'] , function(){
	Route::get('/', 'TransportationController@index');
	Route::post('create', 'TransportationController@store');
	Route::get('{id}/show', 'TransportationController@show');
	Route::post('{id}/edit', 'TransportationController@edit');
	Route::get('{id}/edit', 'TransportationController@edit');
	Route::post('{id}/update', 'TransportationController@update');
	Route::post('{id}/destroy', 'TransportationController@destroy');
	Route::post('export', 'TransportationController@export');
});

Route::group(['prefix' => 'route'] , function(){
	Route::get('/', 'RouteController@index');
	Route::get('create', 'RouteController@create');
	Route::post('create', 'RouteController@store');
	Route::get('{id}/show', 'RouteController@show');
	Route::post('{id}/edit', 'RouteController@edit');
	Route::get('{id}/edit', 'RouteController@edit');
	Route::post('{id}/update', 'RouteController@update');
	Route::post('{id}/destroy', 'RouteController@destroy');
	Route::post('export', 'RouteController@export');
});

Route::group(['prefix' => 'reservation'] , function(){
	Route::get('/', 'ReservationController@index');
	Route::get('create', 'ReservationController@create');
	Route::post('create', 'ReservationController@store');
	Route::get('{id}/show', 'ReservationController@show');
	Route::post('{id}/edit', 'ReservationController@edit');
	Route::get('{id}/edit', 'ReservationController@edit');
	Route::post('{id}/update', 'ReservationController@update');
	Route::post('{id}/destroy', 'ReservationController@destroy');
	Route::post('export', 'ReservationController@export');

});