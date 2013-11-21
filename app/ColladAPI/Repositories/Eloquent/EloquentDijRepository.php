<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:18 PM
 */

namespace ColladAPI\Repositories\Eloquent;


use ColladAPI\Entities\Dij;
use ColladAPI\Repositories\DijRepository;
use ColladAPI\Repositories\Eloquent\EloquentCRUDRepository;

class EloquentDijRepository extends EloquentCRUDRepository implements DijRepository {

    public function __construct(Dij $entity)
    {
        parent::__construct($entity);
    }
}