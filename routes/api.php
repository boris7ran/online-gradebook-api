<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', 'Auth\RegisterController@register');
Route::get('/users', 'Auth\RegisterController@index');

Route::post('/login', 'Auth\LoginController@authenticate');

Route::middleware('jwt')->post('/proffessors', 'ProffessorsController@store');
Route::middleware('jwt')->get('/proffessors', 'ProffessorsController@index');
Route::get('/proffessors/{id}', 'ProffessorsController@show');
Route::middleware('jwt')->get('/proffessors/{id}/user', 'ProffessorsController@showByUser');

Route::middleware('jwt')->delete('/comments/{id}', 'CommentsController@destroy');

Route::middleware('jwt')->post('/gradebooks', 'GradebooksController@store');
Route::get('/gradebooks', 'GradebooksController@index');
Route::get('/gradebooks/{id}', 'GradebooksController@show');
Route::middleware('jwt')->put('/gradebooks/{id}', 'GradebooksController@update');
Route::middleware('jwt')->delete('/gradebooks/{id}', 'GradebooksController@destroy');
Route::middleware('jwt')->post('/gradebooks/{id}/comments', 'GradebooksController@commentStore');
Route::middleware('jwt')->post('/gradebooks/{id}/students', 'GradebooksController@studentStore');