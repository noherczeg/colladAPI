<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:06 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\CRUDService;

interface TDKDolgozatService extends CRUDService {

    public function save(array $dolgozatData);

}