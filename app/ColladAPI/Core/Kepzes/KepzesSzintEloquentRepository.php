<?php namespace ColladAPI\Core\Kepzes;

use Noherczeg\RestExt\Repository\RestExtRepository;

class KepzesSzintEloquentRepository extends RestExtRepository implements KepzesSzintRepository {

    public function __construct(KepzesSzint $entity)
    {
        $this->entity = $entity;
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }

} 