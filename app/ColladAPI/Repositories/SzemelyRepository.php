<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/25/13
 * Time: 9:37 PM
 */

namespace ColladAPI\Repositories;

use ColladAPI\Entities\Szemely;
use ColladAPI\Repositories\CRUDRepository;

interface SzemelyRepository extends CRUDRepository {

    public function findByAPIKey($key);

    public function findByEmail($email);

    public function findByIdWithDijak($id);

    public function saveOrUpdate(Szemely $entity);

}