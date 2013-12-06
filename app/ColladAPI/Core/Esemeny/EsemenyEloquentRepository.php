<?php namespace ColladAPI\Core\Esemeny;

use Noherczeg\RestExt\Repository\RestExtRepository;

class EsemenyEloquentRepository extends RestExtRepository implements  EsemenyRepository {

    public function __construct(Esemeny $esemeny)
    {
        parent::__construct($esemeny);
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }
}