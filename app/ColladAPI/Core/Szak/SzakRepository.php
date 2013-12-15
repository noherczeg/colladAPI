<?php namespace ColladAPI\Core\Szak;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface SzakRepository extends CRUDRepository {

    public function findByIdWithAll($id);

} 