<?php

use Illuminate\Support\Facades\App;

/** Repositoryk */
App::bind('ColladAPI\Core\Szemely\SzemelyRepository',           'ColladAPI\Core\Szemely\SzemelyEloquentRepository');
App::bind('ColladAPI\Core\Szervezet\SzervezetRepository',       'ColladAPI\Core\Szervezet\SzervezetEloquentRepository');
App::bind('ColladAPI\Core\Palyazat\PalyazatRepository',         'ColladAPI\Core\Palyazat\PalyazatEloquentRepository');
App::bind('ColladAPI\Core\Tanszek\TanszekRepository',           'ColladAPI\Core\Tanszek\TanszekEloquentRepository');
App::bind('ColladAPI\Core\Alkotas\AlkotasRepository',           'ColladAPI\Core\Alkotas\AlkotasEloquentRepository');
App::bind('ColladAPI\Core\Dij\DijRepository',                   'ColladAPI\Core\Dij\DijEloquentRepository');
App::bind('ColladAPI\Core\Esemeny\EsemenyRepository',           'ColladAPI\Core\Esemeny\EsemenyEloquentRepository');
App::bind('ColladAPI\Core\Kar\KarRepository',                   'ColladAPI\Core\Kar\Kar\KarEloquentRepository');
App::bind('ColladAPI\Core\Publikacio\PublikacioRepository',     'ColladAPI\Core\Publikacio\PublikacioEloquentRepository');
App::bind('ColladAPI\Core\Tanulmanyut\TanulmanyutRepository',   'ColladAPI\Core\Tanulmanyut\TanulmanyutEloquentRepository');
App::bind('ColladAPI\Core\TDKDolgozat\TDKDolgozatRepository',   'ColladAPI\Core\TDKDolgozat\TDKDolgozatEloquentRepository');
App::bind('ColladAPI\Core\Nyelv\NyelvRepository',               'ColladAPI\Core\Nyelv\NyelvEloquentRepository');
App::bind('ColladAPI\Core\Szerepkor\SzerepkorRepository',       'ColladAPI\Core\Szerepkor\SzerepkorEloquentRepository');
App::bind('ColladAPI\Core\Fokozat\FokozatRepository',           'ColladAPI\Core\Fokozat\FokozatEloquentRepository');

/** Servicek */
App::bind('ColladAPI\Core\Szemely\SzemelyService',              'ColladAPI\Core\Szemely\SzemelyServiceImpl');
App::bind('ColladAPI\Core\Szervezet\SzervezetService',          'ColladAPI\Core\Szervezet\SzervezetServiceImpl');
App::bind('ColladAPI\Core\Palyazat\PalyazatService',            'ColladAPI\Core\Palyazat\PalyazatServiceImpl');
App::bind('ColladAPI\Core\Tanszek\TanszekService',              'ColladAPI\Core\Tanszek\TanszekServiceImpl');
App::bind('ColladAPI\Core\Alkotas\AlkotasService',              'ColladAPI\Core\Alkotas\AlkotasServiceImpl');
App::bind('ColladAPI\Core\Dij\DijService',                      'ColladAPI\Core\Dij\DijServiceImpl');
App::bind('ColladAPI\Core\Esemeny\EsemenyService',              'ColladAPI\Core\Esemeny\EsemenyServiceImpl');
App::bind('ColladAPI\Core\Kar\KarService',                      'ColladAPI\Core\Kar\KarServiceImpl');
App::bind('ColladAPI\Core\Publikacio\PublikacioService',        'ColladAPI\Core\Publikacio\PublikacioServiceImpl');
App::bind('ColladAPI\Core\Tanulmanyut\TanulmanyutService',      'ColladAPI\Core\Tanulmanyut\TanulmanyutServiceImpl');
App::bind('ColladAPI\Core\TDKDolgozat\TDKDolgozatService',      'ColladAPI\Core\TDKDolgozat\TDKDolgozatServiceImpl');
App::bind('ColladAPI\Core\Nyelv\NyelvService',                  'ColladAPI\Core\Nyelv\NyelvServiceImpl');
App::bind('ColladAPI\Core\Szerepkor\SzerepkorService',          'ColladAPI\Core\Szerepkor\SzerepkorServiceImpl');
App::bind('ColladAPI\Core\Fokozat\FokozatService',              'ColladAPI\Core\Fokozat\FokozatServiceImpl');

App::bind('Noherczeg\RestExt\Services\AuthorizationService',    'ColladAPI\Security\Authorization\AuthServiceImpl');