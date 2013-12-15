<?php namespace ColladAPI\Core\Tanszek;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface TanszekRepository extends CRUDRepository {

    public function allForSzemely($id);

    public function findByIdWithAll($id);

}