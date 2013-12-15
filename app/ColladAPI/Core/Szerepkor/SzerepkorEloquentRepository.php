<?php namespace ColladAPI\Core\Szerepkor;

use Noherczeg\RestExt\Repository\RestExtRepository;

class SzerepkorEloquentRepository extends RestExtRepository implements SzerepkorRepository {

    public function __construct(Szerepkor $szerepkor)
    {
        $this->entity = $szerepkor;
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }
}