<?php namespace ColladAPI\Core\Szemely;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface SzemelyRepository extends CRUDRepository {

    public function findByAPIKey($key);

    public function findByEmail($email);

    public function findByIdWithDijak($id);

    public function findByIdWithAll($id);

    public function findTanarokAtTime(\DateTime $atTime);

    public function findHallgatokAtTime(\DateTime $atTime);

    public function findTanarokBetweenTimes(\DateTime $fromTime, \DateTime $toTime);

    public function findHallgatokBetweenTimes(\DateTime $fromTime, \DateTime $toTime);

    public function fokozatokForSzemely($id);

    public function tanszekekForSzemely($id);

}