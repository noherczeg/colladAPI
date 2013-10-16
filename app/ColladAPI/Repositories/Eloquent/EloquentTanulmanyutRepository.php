<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:12 PM
 */
namespace ColladAPI\Repositories\Eloquent;

use ColladAPI\Entities\Tanulmanyut;
use ColladAPI\Repositories\TanulmanyutRepository;

class EloquentTanulmanyutRepository implements TanulmanyutRepository
{

    private $tanulmanyut;

    public function __construct(Tanulmanyut $tanulmanyut)
    {
        $this->tanulmanyut = $tanulmanyut;
    }

    public function all()
    {
        return $this->tanulmanyut->with('tipus', 'orszag')->get();
    }

    public function findById($entityId)
    {
        return $this->tanulmanyut->with('tipus', 'orszag')->findOrFail($entityId);
    }

    public function delete($entityId)
    {
        return $this->tanulmanyut->destroy($entityId);
    }

    public function saveOrUpdate(Tanulmanyut $entity)
    {
        $entity->save();
    }
}