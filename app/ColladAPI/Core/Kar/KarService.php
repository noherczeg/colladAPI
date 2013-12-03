<?php namespace ColladAPI\Core\Kar;

use ColladAPI\Core\Rest\CRUDService;

interface KarService extends CRUDService {

    public function szemelyekByIdAndDate($karId, \DateTime $idopont);

    public function intezetekAndTanszekekByIdAndDate($karId, \DateTime $idopont);

}