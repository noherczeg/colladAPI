<?php namespace ColladAPI\Core\Publikacio;

use Noherczeg\RestExt\Repository\RestExtRepository;

class PublikacioEloquentRepository extends RestExtRepository implements PublikacioRepository {

    public function __construct(Publikacio $entity)
    {
        parent::__construct($entity);
    }
}