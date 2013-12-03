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
use Noherczeg\RestExt\Facades\RestExt;

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

Route::group(array('prefix' => RestExt::getVersion(), 'before' => 'api.auth'), function()
{
    Route::get('/',                         'ColladAPI\Core\Rest\RootController@discover');
    Route::get('szemelyek',                 'ColladAPI\Core\Szemely\SzemelyekController@index');
    Route::get('szemelyek/{id}',            'ColladAPI\Core\Szemely\SzemelyekController@show');
    Route::get('szemelyek/{id}/tanszekek',  'ColladAPI\Core\Szemely\SzemelyekTanszekekController@listTanszekekForSzemely');
    Route::get('szemelyek/{id}/fokozatok',  'ColladAPI\Core\Szemely\SzemelyekFokozatokController@listFokozatokForSzemely');

    Route::get('tanszekek/{id}',            'ColladAPI\Core\Tanszek\TanszekekController@show');

    Route::get('nyelvek',                   'ColladAPI\Core\Nyelv\NyelvekController@index');
    Route::get('nyelvek/{id}',              'ColladAPI\Core\Nyelv\NyelvekController@show');

    Route::get('szerepkorok',               'ColladAPI\Core\Szerepkor\SzerepkorokController@index');
    Route::get('szerepkorok/{id}',          'ColladAPI\Core\Szerepkor\SzerepkorokController@show');

    Route::get('fokozatok',                 'ColladAPI\Core\Fokozat\FokozatokController@index');
    Route::get('fokozatok/{id}',            'ColladAPI\Core\Fokozat\FokozatokController@show');

    Route::get('szervezetek',               'ColladAPI\Core\Szervezet\SzervezetekController@index');
    Route::get('szervezetek/{id}',          'ColladAPI\Core\Szervezet\SzervezetekController@show');

});
