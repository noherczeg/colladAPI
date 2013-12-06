<?php namespace ColladAPI\Core\Dij;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface DijRepository extends CRUDRepository {

    public function findByIdWithAll($id);

}