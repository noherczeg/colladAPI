<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:03 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\CRUDService;

interface DijService extends CRUDService {

    public function save(array $dijData);

}