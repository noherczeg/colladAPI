<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:18 PM
 */

namespace ColladAPI\Repositories\Eloquent;


use ColladAPI\Entities\Dij;
use ColladAPI\Repositories\DijRepository;

class EloquentDijRepository implements DijRepository {

    private $dij;

    public function __construct(Dij $dij)
    {
        $this->dij = $dij;
    }

    public function all()
    {
        return $this->dij->with('orszag', 'szemely')->get();
    }

    public function findById($entityId)
    {
        return $this->dij->with('orszag', 'szemely')->findOrFail($entityId);
    }

    public function delete($entityId)
    {
        return $this->dij->destroy($entityId);
    }

    public function saveOrUpdate(Dij $entity)
    {
        return $entity->save();
    }
}