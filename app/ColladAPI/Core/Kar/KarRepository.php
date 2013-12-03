<?php namespace ColladAPI\Core\Kar;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface KarRepository extends CRUDRepository {

    public function szemelyekByIdAndDate($karId, \DateTime $idopont);

    public function intezetekAndTanszekekByIdAndDate($karId, \DateTime $idopont);

}