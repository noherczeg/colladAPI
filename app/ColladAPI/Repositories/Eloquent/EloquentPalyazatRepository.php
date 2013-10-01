<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 10:21 PM
 */

namespace ColladAPI\Repositories\Eloquent;


use ColladAPI\Entities\Palyazat;
use ColladAPI\Repositories\PalyazatRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentPalyazatRepository implements PalyazatRepository {

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static
     */
    public function all()
    {
        return Palyazat::with('tipus', 'orszag', 'statusz')->get();
    }

    /**
     * @param $entityId
     * @throws ModelNotFoundException
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static     *
     */
    public function findById($entityId)
    {
        return Palyazat::with('tipus', 'orszag', 'statusz')->findOrFail($entityId);
    }

    /**
     * @param $entityId
     * @return bool|null
     */
    public function delete($entityId)
    {
        return Palyazat::destroy($entityId);
    }

    /**
     * @param Palyazat $palyazat
     * @return bool|null
     */
    public function saveOrUpdate(Palyazat $palyazat)
    {
        $palyazat->save();
    }
}