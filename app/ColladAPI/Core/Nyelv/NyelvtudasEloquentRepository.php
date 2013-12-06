<?php namespace ColladAPI\Core\Nyelv;


use Noherczeg\RestExt\Repository\RestExtRepository;

class NyelvtudasEloquentRepository extends RestExtRepository implements NyelvtudasRepository {

    public function __construct(Nyelvtudas $ent)
    {
        $this->entity = $ent;
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }

}