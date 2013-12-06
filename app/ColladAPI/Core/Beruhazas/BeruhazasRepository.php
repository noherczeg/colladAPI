<?php namespace ColladAPI\Core\Beruhazas;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface BeruhazasRepository extends CRUDRepository {

    public function findByIdWithAll($id);

} 