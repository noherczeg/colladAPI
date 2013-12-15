<?php namespace ColladAPI\Core\TDKDolgozat;

use ColladAPI\Core\Rest\CRUDService;

interface TDKDolgozatService extends CRUDService {

    public function findByIdWithAll($id);

}