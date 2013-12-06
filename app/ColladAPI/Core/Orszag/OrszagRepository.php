<?php namespace ColladAPI\Core\Orszag;


use Noherczeg\RestExt\Repository\CRUDRepository;

interface OrszagRepository extends CRUDRepository {

    public function findByIdWithAll($id);

} 