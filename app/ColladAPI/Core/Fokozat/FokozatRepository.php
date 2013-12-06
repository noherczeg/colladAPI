<?php namespace ColladAPI\Core\Fokozat;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface FokozatRepository extends CRUDRepository {

    public function allForSzemely($id);

    public function findByIdWithAll($id);

} 