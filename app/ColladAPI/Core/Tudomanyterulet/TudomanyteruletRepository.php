<?php namespace ColladAPI\Core\TudomanyTerulet;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface TudomanyteruletRepository extends CRUDRepository {

    public function findByIdWithAll($id);

} 