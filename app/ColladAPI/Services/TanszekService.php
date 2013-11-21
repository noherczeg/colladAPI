<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 11:31 PM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\CRUDService;

interface TanszekService extends CRUDService {

    public function szemelyekByDate($tanszekId, \DateTime $date);

}