<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/25/13
 * Time: 9:37 PM
 */

namespace ColladAPI\Repositories;

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