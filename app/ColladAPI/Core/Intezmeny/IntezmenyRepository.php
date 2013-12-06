<?php namespace ColladAPI\Core\Intezmeny;


use Noherczeg\RestExt\Repository\CRUDRepository;

interface IntezmenyRepository extends CRUDRepository {

    public function findByIdWithAll($id);

} 