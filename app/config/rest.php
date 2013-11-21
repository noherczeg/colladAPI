<?php

use ColladAPI\MediaType;
use ColladAPI\Charset;

return array(
	
    /*
    |--------------------------------------------------------------------------
    | Default Media Type Returned
    |--------------------------------------------------------------------------
    |
    | Return Resouces as the following Media Type by default.
    |
    | Can be overwritten by:
    |  - Controller's $media_type field
    |  - Calling produces() method in any method
    |
    */
    
    'media_type' => MediaType::APPLICATION_JSON,
    
    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */
    
    'charset' => Charset::UTF8,
    
    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */
    
    'links' => true,

    /*
    |--------------------------------------------------------------------------
    | Exception on Out Of Bounds Error
    |--------------------------------------------------------------------------
    |
    | Ha lapozas eseten olyan oldalt ker a felhasznalo, ami nem letezik, dobjon
    | kivetelt, vagy sem
    |
    */

    'out_of_bounds_exception' => true,

    /*
    |--------------------------------------------------------------------------
    | 406 Error
    |--------------------------------------------------------------------------
    |
    | Determines what to do if the produces() method is set in a method call,
    |  - true: If the Accept Header doesn't match the produces type, then a 406
    |       page will be generated
    |  - false: the Accept Header doesn't generate any errors if doesn't match
    |       the produces value(es)
    |
    */

    'restrict_accept' => false,

    'prefer_accept' => true,
    
);