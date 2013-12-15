<?php namespace ColladAPI\Core\Szak;

use Noherczeg\RestExt\Repository\RestExtRepository;

class SzakEloquentRepository extends RestExtRepository implements SzakRepository {

    public function __construct(Szak $entity)
    {
        parent::__construct($entity);
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }

} 