<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 8:28 PM
 */

namespace ColladAPI\Repositories;

use ColladAPI\Repositories\CRUDRepository;

interface TanszekRepository extends CRUDRepository {

    public function szemelyekByDate($tanszekId, \DateTime $date);

}