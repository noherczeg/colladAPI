<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 6:15 PM
 */

namespace ColladAPI\Services;


interface KarService extends CRUDService {

    public function szemelyekByIdAndDate($karId, \DateTime $idopont);

    public function intezetekAndTanszekekByIdAndDate($karId, \DateTime $idopont);

}