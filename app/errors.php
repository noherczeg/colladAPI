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
use ColladAPI\Exceptions\ValidationException;

App::error(function (Exception $exception, $code)
{
    Log::error($exception);
});

App::error(function (Symfony\Component\HttpKernel\Exception\HttpException $e, $code)
{
    $headers = $e->getHeaders();
    
    switch ($code) {
        case 401:
            $default_message = 'Hibás API Kulcs';
            $headers['WWW-Authenticate'] = 'Basic realm="Collad API"';
            break;
        
        case 403:
            $default_message = 'Nincs jogosultsága a művelet elvégzésére';
            break;
        
        case 404:
            $default_message = 'A kért erőforrás nem található';
            break;
        
        default:
            $default_message = 'Ismeretlen hiba lépett fel';
    }
    
    return Response::json(array(
        'error' => $e->getMessage() ?  : $default_message
    ), $code, $headers);
});

App::error(function (ErrorMessageException $e)
{
    $messages = $e->getMessages()->all();
    
    return Response::json(array(
        'error' => $messages[0]
    ), 400);
});

App::error(function (NotFoundException $e)
{
    $default_message = 'The requested resource was not found';
    
    return Response::json(array(
        'error' => $e->getMessage() ?  : $default_message
    ), 404);
});

App::error(function (PermissionException $e)
{
    $default_message = 'Insufficient privileges to perform this action';
    
    return Response::json(array(
        'error' => $e->getMessage() ?  : $default_message
    ), 403);
});

App::error(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
{
    return Response::json([
        'error' => 'The requested resource was not found'
    ], 404);
});