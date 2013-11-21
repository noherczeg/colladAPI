<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 6:06 PM
 */

namespace ColladAPI\Repositories;

use ColladAPI\Repositories\CRUDRepository;

interface KarRepository extends CRUDRepository {

    public function szemelyekByIdAndDate($karId, \DateTime $idopont);

    public function intezetekAndTanszekekByIdAndDate($karId, \DateTime $idopont);

}