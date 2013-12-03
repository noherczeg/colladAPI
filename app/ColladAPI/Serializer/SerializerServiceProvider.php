<?php

namespace ColladAPI\Serializer;


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
            return SerializerBuilder::create()->build();
        });
    }
}