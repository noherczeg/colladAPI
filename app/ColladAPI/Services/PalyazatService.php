<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 10:30 PM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\CRUDService;

interface PalyazatService extends CRUDService {

    public function save(array $palyazatData);

}