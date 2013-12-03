<?php namespace ColladAPI\Core\Szervezet;

use Noherczeg\RestExt\Repository\RestExtRepository;

class SzervezetEloquentRepository extends RestExtRepository implements SzervezetRepository {

    public function __construct(Szervezet $szervezet)
    {
        $this->entity = $szervezet;
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }
}