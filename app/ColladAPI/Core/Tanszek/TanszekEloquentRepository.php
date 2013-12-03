<?php namespace ColladAPI\Core\Tanszek;

use Noherczeg\RestExt\Repository\RestExtRepository;

class TanszekEloquentRepository extends RestExtRepository implements TanszekRepository {

    public function __construct(Tanszek $tanszek)
    {
        $this->entity = $tanszek;
    }

    public function allForSzemely($id)
    {
        // TODO: Implement allForSzemely() method.
    }
}