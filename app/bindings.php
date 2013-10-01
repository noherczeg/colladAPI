<?php

/** Repositoryk */
App::bind('ColladAPI\Repositories\SzemelyRepository', 'ColladAPI\Repositories\Eloquent\EloquentSzemelyRepository');
App::bind('ColladAPI\Repositories\PalyazatRepository', 'ColladAPI\Repositories\Eloquent\EloquentPalyazatRepository');
App::bind('ColladAPI\Repositories\TanszekRepository', 'ColladAPI\Repositories\Eloquent\EloquentTanszekRepository');

/** Servicek */
App::bind('ColladAPI\Services\SzemelyService', 'ColladAPI\Services\SzemelyServiceImpl');
App::bind('ColladAPI\Services\PalyazatService', 'ColladAPI\Services\PalyazatServiceImpl');
App::bind('ColladAPI\Services\TanszekService', 'ColladAPI\Services\TanszekServiceImpl');