<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:09 PM
 */

namespace ColladAPI\Repositories;

use ColladAPI\Repositories\CRUDRepository;
use ColladAPI\Entities\Alkotas;

interface AlkotasRepository extends CRUDRepository {

    public function saveOrUpdate(Alkotas $entity);

}