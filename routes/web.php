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

Route::get('/', 'DashboardController@getDashboard');
Route::get('/importer', 'ImportController@getImport');
Route::post('/importer/mailchimp', 'ImportController@postImportMailchimp');
Route::post('/importer/getresponse', 'ImportController@postImportGetResponse');
Route::get('/importer/aweber', 'ImportController@getImportAweber');

Route::get('/lists', 'SubscriberListController@index');
Route::get('/lists/create', 'SubscriberListController@create');
Route::post('/lists', 'SubscriberListController@store');
Route::get('/lists/{id}', 'SubscriberListController@get');
Route::post('/lists/{id}', 'SubscriberListController@update');
Route::get('/lists/delete/{id}', 'SubscriberListController@delete');
Route::get('/lists/{id}/subscribers', 'SubscriberListController@subscribers');

Route::get('/subscribers', 'SubscriberController@index');
Route::get('/subscribers/create', 'SubscriberController@create');
Route::post('/subscribers', 'SubscriberController@store');
Route::get('/subscribers/{id}', 'SubscriberController@get');
Route::post('/subscribers/{id}', 'SubscriberController@update');
Route::get('/subscribers/delete/{id}', 'SubscriberController@delete');
