<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 8:32 PM
 */

namespace ColladAPI\Repositories\Eloquent;

use ColladAPI\Entities\Tanszek;
use ColladAPI\Repositories\TanszekRepository;


class EloquentTanszekRepository extends EloquentCRUDRepository implements TanszekRepository {

    public function __construct(Tanszek $tanszek)
    {
        $this->entity = $tanszek;
    }

    public function all()
    {
        return $this->restCollection($this->entity);
    }
}