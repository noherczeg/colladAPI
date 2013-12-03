<?php namespace ColladAPI\Core\Palyazat;

use Noherczeg\RestExt\Repository\RestExtRepository;

class PalyazatEloquentRepository extends RestExtRepository implements PalyazatRepository {

    public function __construct(Palyazat $palyazat)
    {
        $this->entity = $palyazat;
    }

    public function findById($entityId)
    {
        return $this->entity->with('tipus', 'orszag', 'statusz', 'alkotasok', 'szemelyek', 'tudomanyteruletek')->findOrFail($entityId);
    }
}