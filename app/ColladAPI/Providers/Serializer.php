<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.10.24.
 * Time: 17:13
 */

namespace ColladAPI\Providers;


use Illuminate\Support\Facades\Facade;

class Serializer extends Facade {

    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor(){ return 'serializer'; }

} 