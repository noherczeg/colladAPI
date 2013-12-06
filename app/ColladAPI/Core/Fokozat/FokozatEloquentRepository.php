<?php namespace ColladAPI\Core\Fokozat;

use Noherczeg\RestExt\Repository\RestExtRepository;

class FokozatEloquentRepository extends RestExtRepository implements FokozatRepository {

    public function __construct(Fokozat $fokozat)
    {
        $this->entity = $fokozat;
    }

    public function allForSzemely($id)
    {
        // TODO: Implement allForSzemely() method.
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }
}