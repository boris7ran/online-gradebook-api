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

Route::post('/login', 'Auth\LoginController@authenticate');

Route::middleware('jwt')->post('/proffessors', 'ProffessorsController@store');
Route::middleware('jwt')->get('/proffessors', 'ProffessorsController@index');
Route::middleware('jwt')->get('/proffessors/{id}', 'ProffessorsController@show');

Route::middleware('jwt')->post('/gradebooks', 'GradebooksController@store');
Route::middleware('jwt')->get('/gradebooks', 'GradebooksController@index');
Route::middleware('jwt')->get('/gradebooks/{id}', 'GradebooksController@show');
Route::middleware('jwt')->post('/gradebooks/{id}/comments', 'GradebooksController@commentStore');