<?php namespace ColladAPI\Core\Bevetel;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface BevetelRepository extends CRUDRepository {

    public function findByIdWithAll($id);

} 