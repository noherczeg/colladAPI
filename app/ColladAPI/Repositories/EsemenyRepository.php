<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:11 PM
 */

namespace ColladAPI\Repositories;

use ColladAPI\Repositories\CRUDRepository;
use ColladAPI\Entities\Esemeny;

interface EsemenyRepository extends CRUDRepository {

    public function saveOrUpdate(Esemeny $entity);

}