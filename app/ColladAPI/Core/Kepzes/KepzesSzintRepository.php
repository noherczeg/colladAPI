<?php namespace ColladAPI\Core\Kepzes;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface KepzesSzintRepository extends CRUDRepository {

    public function findByIdWithAll($id);

} 