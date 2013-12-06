<?php namespace ColladAPI\Core\Beruhazas;

use Noherczeg\RestExt\Repository\RestExtRepository;

class BeruhazasEloquentRepository extends RestExtRepository implements BeruhazasRepository {

    public function __construct(Beruhazas $entity)
    {
        parent::__construct($entity);
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }
}