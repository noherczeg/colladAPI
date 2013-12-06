<?php namespace ColladAPI\Core\Intezet;


use Noherczeg\RestExt\Repository\CRUDRepository;

interface IntezetRepository extends CRUDRepository {

    public function findByIdWithAll($id);

} 