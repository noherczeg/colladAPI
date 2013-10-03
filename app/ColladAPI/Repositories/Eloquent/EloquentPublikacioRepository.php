<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:29 PM
 */

namespace ColladAPI\Repositories\Eloquent;


use ColladAPI\Entities\Publikacio;
use ColladAPI\Repositories\PublikacioRepository;

class EloquentPublikacioRepository implements PublikacioRepository {

    private $publikacio;

    public function __construct(Publikacio $publikacio)
    {
        $this->publikacio = $publikacio;
    }

    public function all()
    {
        return $this->publikacio->with('nyelv', 'tipus')->get();
    }

    public function findById($entityId)
    {
        return $this->publikacio->with('nyelv', 'tipus')->findOrFail($entityId);
    }

    public function delete($entityId)
    {
        return $this->publikacio->destroy($entityId);
    }

    public function saveOrUpdate(Publikacio $entity)
    {
        return $entity->save();
    }
}