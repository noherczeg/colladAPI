<?php namespace ColladAPI\Core\TDKDolgozat;

use Noherczeg\RestExt\Repository\RestExtRepository;

class TDKDolgozatEloquentRepository extends RestExtRepository implements TDKDolgozatRepository {

    public function __construct(TDKDolgozat $tdkDolgozat)
    {
        $this->entity = $tdkDolgozat;
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }

}