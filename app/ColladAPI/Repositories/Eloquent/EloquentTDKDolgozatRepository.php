<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:32 PM
 */
namespace ColladAPI\Repositories\Eloquent;

use ColladAPI\Entities\TDKDolgozat;
use ColladAPI\Repositories\TDKDolgozatRepository;

class EloquentTDKDolgozatRepository implements TDKDolgozatRepository
{

    private $tdkDolgozat;

    public function __construct(TDKDolgozat $tdkDolgozat)
    {
        $this->tdkDolgozat = $tdkDolgozat;
    }

    public function all()
    {
        return $this->esemeny->with('supervisedbyszemely', 'kariesemeny', 'otdkesemeny', 'kariszekcio', 'otdktagozat')->get();
    }

    public function findById($entityId)
    {
        return $this->esemeny->with('supervisedbyszemely', 'kariesemeny', 'otdkesemeny', 'kariszekcio', 'otdktagozat')->findOrFail($entityId);
    }

    public function delete($entityId)
    {
        return $this->esemeny->destroy($entityId);
    }

    public function saveOrUpdate(TDKDolgozat $entity)
    {
        return $entity->save();
    }
}