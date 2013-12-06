<?php namespace ColladAPI\Core\Orszag;

use Noherczeg\RestExt\Repository\RestExtRepository;

class OrszagEloquentRepository extends RestExtRepository implements OrszagRepository {

    public function __construct(Orszag $entity)
    {
        parent::__construct($entity);
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }
}