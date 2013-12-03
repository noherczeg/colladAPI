<?php namespace ColladAPI\Core\Szervezet;


use Noherczeg\RestExt\Repository\CRUDRepository;

interface SzervezetRepository extends CRUDRepository {

    public function findByIdWithAll($id);

} 