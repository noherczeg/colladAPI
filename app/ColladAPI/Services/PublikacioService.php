<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:04 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\CRUDService;

interface PublikacioService extends CRUDService {

    public function save(array $publikacioData);

}