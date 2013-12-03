<?php namespace ColladAPI\Core\Nyelv;

use Noherczeg\RestExt\Repository\RestExtRepository;

class NyelvEloquentRepository extends RestExtRepository implements NyelvRepository {

    public function __construct(Nyelv $nyelv)
    {
        $this->entity = $nyelv;
    }

} 