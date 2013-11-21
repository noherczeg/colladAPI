<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/25/13
 * Time: 11:47 PM
 */

use Illuminate\Support\Facades\Log;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Exceptions\NotFoundException;
use ColladAPI\Exceptions\PermissionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(Exception $exception, $code) {
    Log::error($exception);
});

App::error(function(Symfony\Component\HttpKernel\Exception\HttpException $e, $code) {
    $headers = $e->getHeaders();
    $content = ["content" => null, "_links" => [
        ["rel" => "self", "href" => URL::full()],
        ["rel" => "login", "href" => "/login"]
    ]];

    switch ($code)
    {
        case 401:
            $content['content'] = 'Hibás API Kulcs';
            $headers['WWW-Authenticate'] = 'Basic realm="Collad API"';
            break;

        case 403:
            $content['content'] = 'Nincs jogosultsága a művelet elvégzésére';
            break;

        case 404:
            $content['content'] = 'A kért erőforrás nem található';
            break;

        default:
            $content['content'] = 'Ismeretlen hiba lépett fel';
    }

    return Response::json($e->getMessage() ?: $content, $code, $headers);
});

App::error(function(ErrorMessageException $e) {
    $messages = $e->getMessages()->all();

    return Response::json([ 'reason' => $messages[0], ], 400);
});

App::error(function(NotFoundException $e) {
    $default_message = 'a kért erőforrás nem található';

    return Response::json([ 'reason' => $e->getMessage() ?: $default_message, ], 404);
});

App::error(function(PermissionException $e) {
    $default_message = 'nincs jogosultsága a kívánt művelethez';

    return Response::json([ 'reason' => $e->getMessage() ?: $default_message, ], 403);
});

App::error(function(ModelNotFoundException $e)
{
    return Response::json(['reason' => 'a kért erőforrás nem található'], 404);
});