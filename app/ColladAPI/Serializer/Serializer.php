<?php

namespace ColladAPI\Serializer;


use Illuminate\Support\Facades\Facade;

class Serializer extends Facade {

    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor(){ return 'serializer'; }

} 