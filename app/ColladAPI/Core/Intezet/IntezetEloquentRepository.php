<?php namespace ColladAPI\Core\Intezet;


use Noherczeg\RestExt\Repository\RestExtRepository;

class IntezetEloquentRepository extends RestExtRepository implements IntezetRepository {

    public function __construct(Intezet $entity)
    {
        $this->entity = $entity;
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }

} 