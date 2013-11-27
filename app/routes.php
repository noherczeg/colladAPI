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

use Illuminate\Support\Facades\Route;

Route::get('/', function()
{
    return Redirect::to('/v1', 301);
	//return View::make('hello');
    $routes = [];
    foreach (Route::getFacadeRoot()->getRoutes()->all() as $route) {
        $praction = explode("@", $route->getAction());
        $routes[] = [
            "controller" => (strlen($praction[0]) == 0) ? $route->getAction() : $praction[0],
            "action" => (isset($praction[1])) ? $praction[1] : null,
            "params" => $route->getParameters(),
            "path" => $route->getPath(),
            "method" => $route->getMethods()[0]
        ];
    }

    dd($routes);
});

Route::group(array('prefix' => 'v1', 'before' => 'api.auth'), function()
{
    Route::get('/', 'RootController@discover');
    Route::get('szemelyek', 'SzemelyekController@index');
    Route::get('szemelyek/{id}', 'SzemelyekController@show');
    Route::get('szemelyek/{id}/tanszekek', 'SzemelyekTanszekekController@listTanszekekForSzemely');
    Route::get('szemelyek/{id}/fokozatok', 'SzemelyekFokozatokController@listFokozatokForSzemely');

    Route::get('tanszekek/{id}', 'TanszekekController@show');

    Route::get('nyelvek', 'NyelvekController@index');
    Route::get('nyelvek/{id}', 'NyelvekController@show');

    Route::get('szerepkorok', 'SzerepkorokController@index');
    Route::get('szerepkorok/{id}', 'SzerepkorokController@show');

    Route::get('fokozatok', 'FokozatokController@index');
    Route::get('fokozatok/{id}', 'FokozatokController@show');

});
