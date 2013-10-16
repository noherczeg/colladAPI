<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 8:28 PM
 */
namespace ColladAPI\Repositories;

use ColladAPI\Repositories\CRUDRepository;
use ColladAPI\Entities\Tanszek;

interface TanszekRepository extends CRUDRepository
{

    public function saveOrUpdate(Tanszek $entity);

    public function szemelyekByDate($tanszekId,\DateTime $date);
}