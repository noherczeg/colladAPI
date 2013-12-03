<?php namespace ColladAPI\Core\Esemeny;

use Noherczeg\RestExt\Repository\RestExtRepository;

class EsemenyEloquentRepository extends RestExtRepository implements  EsemenyRepository {

    public function __construct(Esemeny $esemeny)
    {
        parent::__construct($esemeny);
    }

    public function findById($entityId)
    {
        return $this->entity->with('tipus', 'szemelyek', 'szemelyek.szerepkor', 'palyazatok', 'otdkdolgozatok', 'karitdkdolgozatok')->findOrFail($entityId);
    }
}