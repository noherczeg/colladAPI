<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:22 PM
 */
namespace ColladAPI\Repositories\Eloquent;

use ColladAPI\Entities\Esemeny;
use ColladAPI\Repositories\EsemenyRepository;

class EloquentEsemenyRepository implements EsemenyRepository
{

    private $esemeny;

    public function __construct(Esemeny $esemeny)
    {
        $this->esemeny = $esemeny;
    }

    public function all()
    {
        return $this->esemeny->with('tipus', 'szemelyek', 'szemelyek.szerepkor', 'palyazatok', 'otdkdolgozatok', 'karitdkdolgozatok')->get();
    }

    public function findById($entityId)
    {
        return $this->esemeny->with('tipus', 'szemelyek', 'szemelyek.szerepkor', 'palyazatok', 'otdkdolgozatok', 'karitdkdolgozatok')->findOrFail($entityId);
    }

    public function delete($entityId)
    {
        return $this->esemeny->destroy($entityId);
    }

    public function saveOrUpdate(Esemeny $entity)
    {
        return $entity->save();
    }
}