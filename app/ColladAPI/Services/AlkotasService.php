<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:02 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\CRUDService;

interface AlkotasService extends CRUDService {

    public function allBetweenDates(\DateTime $from, \DateTime $to);

}