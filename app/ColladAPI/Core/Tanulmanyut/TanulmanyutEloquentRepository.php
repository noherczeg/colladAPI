<?php namespace ColladAPI\Core\Tanulmanyut;

use Noherczeg\RestExt\Repository\RestExtRepository;

class TanulmanyutEloquentRepository extends RestExtRepository implements TanulmanyutRepository {

    public function __construct(Tanulmanyut $tanulmanyut)
    {
        $this->entity = $tanulmanyut;
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }
}