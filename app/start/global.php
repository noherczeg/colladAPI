<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/database/seeds',
    app_path().'/ColladAPI',
    app_path().'/ColladAPI/Core',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a rotating log file setup which creates a new file each day.
|
*/

//$logFile = 'log-'.php_sapi_name().'.txt';
//Log::useDailyFiles(storage_path().'/logs/'.$logFile);

Log::listen(function($level, $message, $context) {

    // Save the php sapi and date, because the closure needs to be serialized
    $apiName = php_sapi_name();
    $date = new DateTime;

    Queue::push(function() use ($level, $message, $context, $apiName, $date) {
        DB::insert("INSERT INTO log (php_sapi_name, level, message, context, created_at) VALUES (?, ?, ?, ?, ?)", array(
            $apiName,
            $level,
            $message,
            json_encode($context),
            $date
        ));
    });

});

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenace mode is in effect for this application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/bindings.php';
require app_path().'/filters.php';
require app_path().'/errors.php';