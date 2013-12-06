<?php namespace ColladAPI\Core\Alkotas;

use ColladAPI\Core\Rest\CRUDService;

interface AlkotasService extends CRUDService {

    public function allBetweenDates(\DateTime $from, \DateTime $to);

    public function findByIdWithAll($id);

}