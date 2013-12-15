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

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Noherczeg\RestExt\Facades\RestExt;

Route::get('/', function()
{

    //$pivotData = array();

    // relate($modelName, $modelId, array $pivotData)
    /*$parent = \ColladAPI\Core\Publikacio\Publikacio::findOrFail(1);

    $modelName = '\ColladAPI\Core\Palyazat\Palyazat';
    $modelId = 3;

    $modelToAttach = $modelName::findOrFail($modelId);
    $relToAttach = $modelToAttach->getRootRelName();

    $relationInstance = $parent->$relToAttach();
    dd($relationInstance);

    if ($relationInstance instanceof \Illuminate\Database\Eloquent\Relations\BelongsToMany || $relationInstance instanceof $relationInstance instanceof \Illuminate\Database\Eloquent\Relations\HasOneOrMany) {
        $relationInstance->save($modelToAttach, $pivotData);
    }


    dd($pub->load('palyazatok')->getRelation('palyazatok'));*/
    return Redirect::to('/v1', 301);
});

Route::group(array('prefix' => RestExt::getVersion(), 'before' => 'api.auth'), function()
{
    // ENTRY POINT
    Route::get('/','ColladAPI\Core\Rest\RootController@discover');

    // BERUHAZASOK
    Route::resource('beruhazasok', 'ColladAPI\Core\Beruhazas\BeruhazasokController', array('except' => array('create', 'edit')));

    // DIJAK
    Route::resource('dijak', 'ColladAPI\Core\Dij\DijakController', array('except' => array('create', 'edit')));

    // ESEMENYEK
    Route::resource('esemenyek', 'ColladAPI\Core\Esemeny\EsemenyekController', array('except' => array('create', 'edit')));

    // INTEZETEK
    Route::resource('intezetek', 'ColladAPI\Core\Intezet\IntezetekController', array('except' => array('create', 'edit')));

    // INTEZMENYEK
    Route::resource('intezmenyek', 'ColladAPI\Core\Intezmeny\IntezmenyekController', array('except' => array('create', 'edit')));

    // KEPZESSZINTEK
    Route::resource('kepzesszintek', 'ColladAPI\Core\Kepzes\KepzesSzintekController', array('except' => array('create', 'edit')));

    // BEVETELEK
    Route::resource('bevetelek', 'ColladAPI\Core\Bevetel\BevetelekController', array('except' => array('create', 'edit')));

    // SZEMELYEK
    Route::resource('szemelyek', 'ColladAPI\Core\Szemely\SzemelyekController', array('except' => array('create', 'edit')));

    Route::get('szemelyek/{id}/tanszekek',  'ColladAPI\Core\Szemely\SzemelyekTanszekekController@listTanszekekForSzemely');
    Route::get('szemelyek/{id}/fokozatok',  'ColladAPI\Core\Szemely\SzemelyekFokozatokController@listFokozatokForSzemely');

    // TANSZEKEK
    Route::resource('tanszekek', 'ColladAPI\Core\Tanszek\TanszekekController', array('except' => array('create', 'edit')));

    // SZAKOK
    Route::resource('szakok', 'ColladAPI\Core\Szak\SzakokController', array('except' => array('create', 'edit')));

    // TANULMANYUTAK
    Route::resource('tanulmanyutak', 'ColladAPI\Core\Tanulmanyut\TanulmanyutakController', array('except' => array('create', 'edit')));

    // TDKDOLGOZATOK
    Route::resource('tdkdolgozatok', 'ColladAPI\Core\TDKDolgozat\TDKDolgozatokController', array('except' => array('create', 'edit')));

    // SZEREPKOROK
    Route::resource('szerepkorok', 'ColladAPI\Core\Szerepkor\SzerepkorokController', array('except' => array('create', 'edit')));

    // TUDOMANYTERULETEK
    Route::resource('tudomanyteruletek', 'ColladAPI\Core\Tudomanyterulet\TudomanyteruletekController', array('except' => array('create', 'edit')));

    // NYELVEK
    Route::resource('nyelvek', 'ColladAPI\Core\Nyelv\NyelvekController', array('except' => array('create', 'edit')));

    // NYELVTUDASOK
    Route::resource('nyelvtudasok', 'ColladAPI\Core\Nyelv\NyelvtudasokController', array('except' => array('create', 'edit')));

    // SZEREPKOROK
    Route::resource('szerepkorok', 'ColladAPI\Core\Szerepkor\SzerepkorokController', array('except' => array('create', 'edit')));

    // FOKOZATOK
    Route::resource('fokozatok', 'ColladAPI\Core\Fokozat\FokozatokController', array('except' => array('create', 'edit')));

    // SZERVEZETEK
    Route::resource('szervezetek', 'ColladAPI\Core\Szervezet\SzervezetekController', array('except' => array('create', 'edit')));

    // ORSZAGOK
    Route::resource('orszagok', 'ColladAPI\Core\Orszag\OrszagokController', array('except' => array('create', 'edit')));

    // ALKOTASOK
    Route::resource('alkotasok', 'ColladAPI\Core\Alkotas\AlkotasokController', array('except' => array('create', 'edit')));

    // PUBLIKACIOK
    Route::resource('publikaciok', 'ColladAPI\Core\Publikacio\PublikaciokController', array('except' => array('create', 'edit')));
    Route::resource('publikaciok.nyelvek', 'ColladAPI\Core\Publikacio\PublikaciokNyelvekController', array('except' => array('create', 'edit')));

});
