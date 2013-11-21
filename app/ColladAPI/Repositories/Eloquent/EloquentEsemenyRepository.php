<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:22 PM
 */

namespace ColladAPI\Repositories\Eloquent;


use ColladAPI\Entities\Esemeny;
use ColladAPI\Repositories\EsemenyRepository;
use ColladAPI\Repositories\Eloquent\EloquentCRUDRepository;

class EloquentEsemenyRepository extends EloquentCRUDRepository implements EsemenyRepository {

    public function __construct(Esemeny $esemeny)
    {
        parent::__construct($esemeny);
    }

    public function all()
    {
        return $this->entity->with('tipus', 'szemelyek', 'szemelyek.szerepkor', 'palyazatok', 'otdkdolgozatok', 'karitdkdolgozatok')->get();
    }

    public function findById($entityId)
    {
        return $this->entity->with('tipus', 'szemelyek', 'szemelyek.szerepkor', 'palyazatok', 'otdkdolgozatok', 'karitdkdolgozatok')->findOrFail($entityId);
    }
}