<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:10 PM
 */

namespace ColladAPI\Repositories;

use ColladAPI\Repositories\CRUDRepository;
use ColladAPI\Entities\Publikacio;

interface PublikacioRepository extends CRUDRepository {

    public function saveOrUpdate(Publikacio $entity);

}