<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:29 PM
 */

namespace ColladAPI\Repositories\Eloquent;

use ColladAPI\Entities\Publikacio;
use ColladAPI\Repositories\PublikacioRepository;
use ColladAPI\Repositories\Eloquent\EloquentCRUDRepository;

class EloquentPublikacioRepository extends EloquentCRUDRepository implements PublikacioRepository {

    public function __construct(Publikacio $entity)
    {
        parent::__construct($entity);
    }
}