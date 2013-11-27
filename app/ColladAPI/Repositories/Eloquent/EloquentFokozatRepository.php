<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.27.
 * Time: 16:55
 */

namespace ColladAPI\Repositories\Eloquent;


use ColladAPI\Entities\Fokozat;
use ColladAPI\Repositories\FokozatRepository;

class EloquentFokozatRepository extends EloquentCRUDRepository implements FokozatRepository {

    public function __construct(Fokozat $fokozat)
    {
        $this->entity = $fokozat;
    }

    public function all()
    {
        return $this->restCollection($this->entity);
    }

} 