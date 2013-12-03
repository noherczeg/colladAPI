<?php namespace ColladAPI\Core\Tanszek;

use ColladAPI\Core\Rest\CRUDService;

interface TanszekService extends CRUDService {

    public function allForSzemely($id);

}