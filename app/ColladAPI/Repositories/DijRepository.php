<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:08 PM
 */
namespace ColladAPI\Repositories;

use ColladAPI\Repositories\CRUDRepository;
use ColladAPI\Entities\Dij;

interface DijRepository extends CRUDRepository
{

    public function saveOrUpdate(Dij $entity);
}