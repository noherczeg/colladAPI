<?php namespace ColladAPI\Core\Tanulmanyut;

use Noherczeg\RestExt\Repository\RestExtRepository;

class TanulmanyutEloquentRepository extends RestExtRepository implements TanulmanyutRepository {

    public function __construct(Tanulmanyut $tanulmanyut)
    {
        $this->entity = $tanulmanyut;
    }

    public function all()
    {
        return $this->entity->with('tipus', 'orszag')->get();
    }

    public function findById($entityId)
    {
        return $this->entity->with('tipus', 'orszag')->findOrFail($entityId);
    }

}