<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/27/13
 * Time: 1:20 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\CRUDService;

interface SzemelyService extends CRUDService {

    public function findByIdWithDijak($id);

    public function register(array $userData);

}