<?php namespace ColladAPI\Core\Intezmeny;


use Noherczeg\RestExt\Repository\RestExtRepository;

class IntezmenyEloquentRepository extends RestExtRepository implements IntezmenyRepository {

    public function __construct(Intezmeny $entity)
    {
        $this->entity = $entity;
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }
}