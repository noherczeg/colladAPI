<?php namespace ColladAPI\Core\TDKDolgozat;

use ColladAPI\Core\Rest\CRUDService;

interface TDKDolgozatRepository extends CRUDService {

    public function findByIdWithAll($id);

}