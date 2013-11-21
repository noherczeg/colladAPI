<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 10:21 PM
 */

namespace ColladAPI\Repositories\Eloquent;

use ColladAPI\Entities\Palyazat;
use ColladAPI\Repositories\PalyazatRepository;
use ColladAPI\Repositories\Eloquent\EloquentCRUDRepository;

class EloquentPalyazatRepository extends EloquentCRUDRepository implements PalyazatRepository {

    public function __construct(Palyazat $palyazat)
    {
        $this->entity = $palyazat;
    }

    public function all()
    {
        return $this->entity->with('tipus', 'orszag', 'statusz')->get();
    }

    public function findById($entityId)
    {
        return $this->entity->with('tipus', 'orszag', 'statusz', 'alkotasok', 'szemelyek', 'tudomanyteruletek')->findOrFail($entityId);
    }
}