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
}