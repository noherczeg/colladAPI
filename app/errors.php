<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Noherczeg\RestExt\Exceptions\ErrorMessageException;
use Noherczeg\RestExt\Exceptions\NotFoundException;
use Noherczeg\RestExt\Exceptions\PermissionException;
use Noherczeg\RestExt\Exceptions\ValidationException;

App::error(function(Exception $exception, $code) {
    Log::error($exception);
});

App::error(function(Symfony\Component\HttpKernel\Exception\HttpException $e, $code) {
    $headers = $e->getHeaders();
    $content = ["reason" => null, "links" => [
        ["rel" => "self", "href" => URL::full()],
        ["rel" => "referer", "href" => URL::previous()],
    ]];

    switch ($code)
    {
        case 401:
            $content['reason'] = 'Hibás API Kulcs';
            $headers['WWW-Authenticate'] = 'Basic realm="Collad API"';
            break;

        case 403:
            $content['reason'] = 'Nincs jogosultsága a művelet elvégzésére';
            break;

        case 404:
            $content['reason'] = 'A kért erőforrás nem található';
            break;

        case 406:
            $content['reason'] = 'A küldött Content-Type nem engedélyezett';
            break;

        default:
            $content['reason'] = 'Ismeretlen hiba lépett fel';
    }

    return Response::json($e->getMessage() ?: $content, $code, $headers);
});

App::error(function(ValidationException $e) {
    $messages = $e->getMessages()->all();

    return Response::json([ 'reason' => $messages->all(), ], 400);
});

App::error(function(ErrorMessageException $e) {
    $onlyFirstMessagePerField = [];

    foreach ($e->getMessages() as $key => $error) {
        $onlyFirstMessagePerField[$key] = $error[0];
    }

    return Response::json([ 'reason' => $onlyFirstMessagePerField ], 400);
});

App::error(function(NotFoundException $e) {
    $default_message = 'a kért oldal nem található';

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

App::error(function(\Predis\Connection\ConnectionException $e)
{
    return Response::json(['reason' => 'a Cache szerver nem válaszol'], 500);
});

App::error(function(\Doctrine\DBAL\ConnectionException $e)
{
    return Response::json(['reason' => 'az adatbázis szerver nem válaszol'], 500);
});
