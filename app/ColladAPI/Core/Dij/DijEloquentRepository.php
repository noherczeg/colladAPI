<?php namespace ColladAPI\Core\Dij;

use Noherczeg\RestExt\Repository\RestExtRepository;

class DijEloquentRepository extends RestExtRepository implements DijRepository {

    public function __construct(Dij $entity)
    {
        parent::__construct($entity);
    }
}