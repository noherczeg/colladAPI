<?php

use Illuminate\Support\Facades\Response;
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
	return Response::make('hello', 200);
});

Route::resource('szemelyek', 'SzemelyekController');
Route::resource('palyazatok', 'PalyazatokController');
Route::resource('tanszekek', 'TanszekekController');