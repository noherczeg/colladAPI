<?php namespace ColladAPI\Core\Bevetel;

use Noherczeg\RestExt\Repository\RestExtRepository;

class BevetelEloquentRepository extends RestExtRepository implements BevetelRepository {

    public function __construct(Bevetel $entity)
    {
        parent::__construct($entity);
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }

}