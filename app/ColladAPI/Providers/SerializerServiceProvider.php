<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.10.24.
 * Time: 16:47
 */

namespace ColladAPI\Providers;


use Illuminate\Support\ServiceProvider;
use JMS\Serializer\SerializerBuilder;

class SerializerServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['serializer'] = $this->app->share(function($app)
        {
            return SerializerBuilder::create()->build();;
        });
    }
}