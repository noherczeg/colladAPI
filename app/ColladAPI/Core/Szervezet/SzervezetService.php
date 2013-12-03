<?php namespace ColladAPI\Core\Szervezet;


use ColladAPI\Core\Rest\CRUDService;

interface SzervezetService extends CRUDService {

    public function findByIdWithAll($szervezetId);

} 