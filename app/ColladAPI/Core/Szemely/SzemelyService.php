<?php namespace ColladAPI\Core\Szemely;

use ColladAPI\Core\Rest\CRUDService;

interface SzemelyService extends CRUDService {

    public function tanarok();

    public function hallgatok();

    public function register(array $userData);

    public function findByIdWithAll($szemelyId);

    public function findTanarByIdWithAll($id, \DateTime $atTime);

    public function findHallgatoByIdWithAll($id, \DateTime $atTime);

    public function findTanarokAtTime(\DateTime $atTime);

    public function findHallgatokAtTime(\DateTime $atTime);

    public function findTanarokBetweenTimes(\DateTime $fromTime, \DateTime $toTime);

    public function findHallgatokBetweenTimes(\DateTime $fromTime, \DateTime $toTime);

    public function fokozatokForSzemely($id);

}