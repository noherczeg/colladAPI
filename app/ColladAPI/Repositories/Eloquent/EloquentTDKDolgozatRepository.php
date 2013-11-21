<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:32 PM
 */

namespace ColladAPI\Repositories\Eloquent;


use ColladAPI\Entities\TDKDolgozat;
use ColladAPI\Repositories\TDKDolgozatRepository;
use ColladAPI\Repositories\Eloquent\EloquentCRUDRepository;

class EloquentTDKDolgozatRepository extends EloquentCRUDRepository implements TDKDolgozatRepository {

    public function __construct(TDKDolgozat $tdkDolgozat)
    {
        $this->entity = $tdkDolgozat;
    }

    public function findById($entityId)
    {
        return $this->entity->with('supervisedbyszemely', 'kariesemeny', 'otdkesemeny', 'kariszekcio', 'otdktagozat')->findOrFail($entityId);
    }

}