<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 8:32 PM
 */

namespace ColladAPI\Repositories\Eloquent;

use ColladAPI\Entities\Tanszek;
use ColladAPI\Repositories\TanszekRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentTanszekRepository implements TanszekRepository {

    private $tanszek;

    public function __construct(Tanszek $tanszek)
    {
        $this->tanszek = $tanszek;
    }

    public function all()
    {
        return $this->tanszek->with('szemelyek')->get();
    }

    public function findById($szemelyId)
    {
        return $this->tanszek->find($szemelyId);
    }

    public function delete($entityId)
    {
        return $this->tanszek->destroy($entityId);
    }

    public function saveOrUpdate(Tanszek $entity)
    {
        return $entity->save();
    }

    /**
     * @param $tanszekId
     * @param \DateTime $date
     * @return \Illuminate\Database\Eloquent\Collection|static
     * @throws ModelNotFoundException
     */
    public function szemelyekByDate($tanszekId, \DateTime $date)
    {
        $tanszekek =  $this->tanszek->with(['szemelyek' => function($query) use ($date) {
            $query->where('kezdo_datum', '<=', $date->format('Y-m-d'))->where('vege_datum', '>=', $date->format('Y-m-d'));
        }])->firstOrFail();

        $szemelyek = $tanszekek->szemelyek;
        if($szemelyek->isEmpty())
            throw new ModelNotFoundException;

        return $tanszekek->szemelyek;
    }
}