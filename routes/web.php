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

//PDF
Route::get('/ver/{type}/{id}', 'PdfController@show');
Route::get('/download/{type}/{id}', 'PdfController@download');

//Auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//Resources
Route::resources([
    'documents' => 'DocumentController',
    'reviews' => 'ReviewController',
    'shared' => 'SharedController'
]);

	
Route::get('documents/create/{type}', 'DocumentController@create');
Route::get('reviews/document/{id}', 'ReviewController@index');
Route::get('shared/document/{id}', 'SharedController@index');
