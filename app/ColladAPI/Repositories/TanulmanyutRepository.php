<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:07 PM
 */

namespace ColladAPI\Repositories;

use ColladAPI\Entities\Tanulmanyut;
use ColladAPI\Repositories\CRUDRepository;

interface TanulmanyutRepository extends CRUDRepository {

    public function saveOrUpdate(Tanulmanyut $entity);

}