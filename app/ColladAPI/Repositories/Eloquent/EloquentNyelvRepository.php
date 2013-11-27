<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.26.
 * Time: 17:22
 */

namespace ColladAPI\Repositories\Eloquent;


use ColladAPI\Entities\Nyelv;
use ColladAPI\Repositories\NyelvRepository;

class EloquentNyelvRepository extends EloquentCRUDRepository implements NyelvRepository {

    public function __construct(Nyelv $nyelv)
    {
        $this->entity = $nyelv;
    }

    /**
     * Feluldefinialjuk az all() metodust, hogy lapozhato Collection-t is tudjon visszaadni.
     *
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator|static|static[]
     */
    public function all()
    {
        return $this->restCollection($this->entity);
    }
} 