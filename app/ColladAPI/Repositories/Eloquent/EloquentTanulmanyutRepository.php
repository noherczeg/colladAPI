<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:12 PM
 */

namespace ColladAPI\Repositories\Eloquent;


use ColladAPI\Entities\Tanulmanyut;
use ColladAPI\Repositories\TanulmanyutRepository;
use ColladAPI\Repositories\Eloquent\EloquentCRUDRepository;

class EloquentTanulmanyutRepository extends EloquentCRUDRepository implements TanulmanyutRepository {

    public function __construct(Tanulmanyut $tanulmanyut)
    {
        $this->entity = $tanulmanyut;
    }

    public function all()
    {
        return $this->tanulmanyut->with('tipus', 'orszag')->get();
    }

    public function findById($entityId)
    {
        return $this->tanulmanyut->with('tipus', 'orszag')->findOrFail($entityId);
    }

}