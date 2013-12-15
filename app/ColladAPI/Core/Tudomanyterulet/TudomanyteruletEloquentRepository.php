<?php namespace ColladAPI\Core\TudomanyTerulet;

use Noherczeg\RestExt\Repository\RestExtRepository;

class TudomanyteruletEloquentRepository extends RestExtRepository implements TudomanyteruletRepository {

    public function __construct(TudomanyTerulet $entity)
    {
        $this->entity = $entity;
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }

} 