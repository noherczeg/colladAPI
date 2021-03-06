<?php

use Noherczeg\RestExt\Providers\Charset;
use Noherczeg\RestExt\Providers\MediaType;

return array(

    /*
    |--------------------------------------------------------------------------
    | Media Type of Responses
    |--------------------------------------------------------------------------
    |
    | Default Media Type of Responses sent back to clients. Not only does it
    | set the headers, but the serialization will be handled accordingly as
    | well.
    |
    | This value can be overriden in Controllers.
    |
    | Default:  MediaType::APPLICATION_JSON
    |
    */

    'media_type' => MediaType::APPLICATION_JSON,

    /*
    |--------------------------------------------------------------------------
    | Response Encoding
    |--------------------------------------------------------------------------
    |
    | You can set the default Encoding of your Responses here, but it's not
    | a great practice to do so since according to RFC4627 the advised
    | encoding of JSON Responses is UTF-8!
    |
    | This configuration only sets the Response Headers, and is not involved in
    | the conversion/handling of the actual data in them!
    |
    | Default: Charset::UTF8
    |
    */

    'encoding' => Charset::UTF8,

    /*
    |--------------------------------------------------------------------------
    | Exception on Out Of Bounds Error
    |--------------------------------------------------------------------------
    |
    | Turns on / off Exceptions when a user requests pages which don't exist
    | on a particular Resource. These Exceptions should be caught in the
    | filters.php file and handled accordingly (404 Responses).
    |
    | Default: true
    |
    */

    'paging_out_of_bounds_exception' => true,

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

    /*
    |--------------------------------------------------------------------------
    | MediaType preference
    |--------------------------------------------------------------------------
    |
    | Not yet used!
    |
    | Should set wether the Accept Header should be prioritized, or the extension
    |
    */

    'prefer_accept' => true,

    /*
    |--------------------------------------------------------------------------
    | Pagination Parameter name
    |--------------------------------------------------------------------------
    |
    | Name of the Query String Parameter which is used for pagination.
    |
    */

    'page_param' => 'page',

    'page_limit_param' => 'limit',

    'page_limit_default' => 10,

    'access_policy' => 'blacklist',

    'version' => 'v1',

);