<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 10:20 PM
 */
namespace ColladAPI\Repositories;

use ColladAPI\Entities\Palyazat;
use ColladAPI\Repositories\CRUDRepository;

interface PalyazatRepository extends CRUDRepository
{

    public function saveOrUpdate(Palyazat $palyazat);
}