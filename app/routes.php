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
	//return View::make('hello');
    foreach (Route::getFacadeRoot()->getRoutes()->all() as $route) {
        $praction = explode("@", $route->getAction());
        var_dump([
            "controller" => (strlen($praction[0]) == 0) ? $route->getAction() : $praction[0],
            "action" => (isset($praction[1])) ? $praction[1] : null,
            "params" => $route->getParameters(),
            "path" => $route->getPath(),
            "method" => $route->getMethods()[0]
        ]);
    }

});

Route::get('/asd', function()
{
    $resp = ['content' => null, 'links' => null];

    /*$szemely = new \ColladAPI\Entities\Szemely();
    $szemely->email = 'noherczeg@gmail.com';
    $szemely->ehaKod = 'HENSAAP.PTE';
    $szemely->jelszo = 'n0h3rc23g';

    $szemely->save();*/

    //dd(Auth::attempt(array('email' => 'noherczeg@gmail.com', 'password' => 'n0h3rc23g')));
    //dd(Auth::check());
    //dd(Entrust::hasRole('Admin'));
    //Auth::logout();
    $uri = 'asd';
    $users = \ColladAPI\Entities\Szemely::paginate(2);
    //$users->setBaseUrl('custom/url');
    $users->links();
    $resp['content'] = $users->getCollection()->toArray();
    $resp['pages'] = ['total' => $users->getTotal(), 'perPage' => $users->getPerPage()];
    $resp['pages']['firstPage'] = ($users->getCurrentPage() == 1) ? true : false;
    $resp['pages']['lastPage'] = ($users->getCurrentPage() == $users->getLastPage()) ? true : false;
    $resp['links'][] = ['rel' => 'self', 'href' => URL::full()];
    $resp['links'][] = ['rel' => 'first', 'href' => URL::to($uri . '?page=1')];
    if ($users->getCurrentPage() > 1)
        $resp['links'][] = ['rel' => 'previous', 'href' => URL::to($uri . '?page=' . ($users->getCurrentPage() - 1))];

    if ($users->getCurrentPage() < $users->getLastPage())
        $resp['links'][] = ['rel' => 'next', 'href' => URL::to($uri . '?page=' . ($users->getCurrentPage() + 1))];
    $resp['links'][] = ['rel' => 'last', 'href' => URL::to($uri . '?page=' . $users->getLastPage())];

    //return Response::json($users);
    //dd($users);
    return Response::json($resp);

});

Route::get('profile', array('before' => 'api.auth', function()
{
    dd('okay');
}));

Route::group(array('prefix' => 'v1', 'before' => 'api.auth'), function()
{
    Route::resource('szemelyek', 'SzemelyekController');
    Route::resource('palyazatok', 'PalyazatokController');
    Route::resource('szemelyek.tanszekek', 'TanszekekController');
    Route::resource('tanulmanyutak', 'TanulmanyutakController');
    Route::resource('tdkdolgozatok', 'TDKDolgozatokController');
    Route::resource('dijak', 'DijakController');
    Route::resource('alkotasok', 'AlkotasokController');
    Route::resource('publikaciok', 'PublikaciokController');
    Route::resource('esemenyek', 'EsemenyekController');
});
