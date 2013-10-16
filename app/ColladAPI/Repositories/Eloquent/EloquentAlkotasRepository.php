<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:15 PM
 */
namespace ColladAPI\Repositories\Eloquent;

use ColladAPI\Entities\Alkotas;
use ColladAPI\Repositories\AlkotasRepository;

class EloquentAlkotasRepository implements AlkotasRepository
{

    private $alkotas;

    public function __construct(Alkotas $alkotas)
    {
        $this->alkotas = $alkotas;
    }

    public function saveOrUpdate(Alkotas $entity)
    {
        return $entity->save();
    }

    public function all()
    {
        return $this->alkotas->with('tipus', 'palyazatok')->get();
    }

    public function findById($entityId)
    {
        return $this->alkotas->with('tipus', 'palyazatok')->findOrFail($entityId);
    }

    public function delete($entityId)
    {
        return $this->alkotas->destroy($entityId);
    }
}