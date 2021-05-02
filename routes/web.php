<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PostsController@list');
Route::get('/post/insert', 'PostsController@insert');
Route::post('/post/insert', 'PostsController@do_insert');
Route::get('/post/{id}/update', 'PostsController@update');
Route::post('/post/{id}/update', 'PostsController@do_update');
Route::get('/post/{id}/drop', 'PostsController@drop');
Route::get('/post/{id}', 'PostsController@show');
Route::get('/post/{id}/comment','PostsController@comment_page');
Route::post('/post/{id}/comment','PostsController@comment');


Auth::routes(['reset'=>false]);

//Route::get('/home', 'HomeController@index')->name('home');
