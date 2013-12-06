<?php namespace ColladAPI\Core\Nyelv;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface NyelvtudasRepository extends CRUDRepository {

    public function findByIdWithAll($id);

} 