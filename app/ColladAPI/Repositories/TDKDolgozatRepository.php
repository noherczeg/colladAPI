<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:11 PM
 */
namespace ColladAPI\Repositories;

use ColladAPI\Repositories\CRUDRepository;
use ColladAPI\Entities\TDKDolgozat;

interface TDKDolgozatRepository extends CRUDRepository
{

    public function saveOrUpdate(TDKDolgozat $entity);
}