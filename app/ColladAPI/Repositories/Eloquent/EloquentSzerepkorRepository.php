<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.27.
 * Time: 1:08
 */

namespace ColladAPI\Repositories\Eloquent;


use ColladAPI\Entities\Szerepkor;
use ColladAPI\Repositories\SzerepkorRepository;

class EloquentSzerepkorRepository extends EloquentCRUDRepository implements SzerepkorRepository {

    public function __construct(Szerepkor $szerepkor)
    {
        $this->entity = $szerepkor;
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