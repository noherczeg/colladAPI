<?php

/** Repositoryk */
App::bind('ColladAPI\Repositories\SzemelyRepository', 'ColladAPI\Repositories\Eloquent\EloquentSzemelyRepository');
App::bind('ColladAPI\Repositories\PalyazatRepository', 'ColladAPI\Repositories\Eloquent\EloquentPalyazatRepository');
App::bind('ColladAPI\Repositories\TanszekRepository', 'ColladAPI\Repositories\Eloquent\EloquentTanszekRepository');
App::bind('ColladAPI\Repositories\AlkotasRepository', 'ColladAPI\Repositories\Eloquent\EloquentAlkotasRepository');
App::bind('ColladAPI\Repositories\DijRepository', 'ColladAPI\Repositories\Eloquent\EloquentDijRepository');
App::bind('ColladAPI\Repositories\EsemenyRepository', 'ColladAPI\Repositories\Eloquent\EloquentEsemenyRepository');
App::bind('ColladAPI\Repositories\KarRepository', 'ColladAPI\Repositories\Eloquent\EloquentKarRepository');
App::bind('ColladAPI\Repositories\PublikacioRepository', 'ColladAPI\Repositories\Eloquent\EloquentPublikacioRepository');
App::bind('ColladAPI\Repositories\TanulmanyutRepository', 'ColladAPI\Repositories\Eloquent\EloquentTanulmanyutRepository');
App::bind('ColladAPI\Repositories\TDKDolgozatRepository', 'ColladAPI\Repositories\Eloquent\EloquentTDKDolgozatRepository');

/** Servicek */
App::bind('ColladAPI\Services\SzemelyService', 'ColladAPI\Services\SzemelyServiceImpl');
App::bind('ColladAPI\Services\PalyazatService', 'ColladAPI\Services\PalyazatServiceImpl');
App::bind('ColladAPI\Services\TanszekService', 'ColladAPI\Services\TanszekServiceImpl');
App::bind('ColladAPI\Services\AlkotasService', 'ColladAPI\Services\AlkotasServiceImpl');
App::bind('ColladAPI\Services\DijService', 'ColladAPI\Services\DijServiceImpl');
App::bind('ColladAPI\Services\EsemenyService', 'ColladAPI\Services\EsemenyServiceImpl');
App::bind('ColladAPI\Services\KarService', 'ColladAPI\Services\KarServiceImpl');
App::bind('ColladAPI\Services\PublikacioService', 'ColladAPI\Services\PublikacioServiceImpl');
App::bind('ColladAPI\Services\TanulmanyutService', 'ColladAPI\Services\TanulmanyutServiceImpl');
App::bind('ColladAPI\Services\TDKDolgozatService', 'ColladAPI\Services\TDKDolgozatServiceImpl');
