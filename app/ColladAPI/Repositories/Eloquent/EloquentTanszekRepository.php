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
use ColladAPI\Repositories\Eloquent\EloquentCRUDRepository;

class EloquentTanszekRepository extends EloquentCRUDRepository implements TanszekRepository {

    public function __construct(Tanszek $tanszek)
    {
        $this->entity = $tanszek;
    }

    /**
     * @param $tanszekId
     * @param \DateTime $date
     * @return \Illuminate\Database\Eloquent\Collection|static
     * @throws ModelNotFoundException
     */
    public function szemelyekByDate($tanszekId, \DateTime $date)
    {
        $tanszekek =  $this->entity->with(['szemelyek' => function($query) use ($date) {
            $query->where('kezdo_datum', '<=', $date->format('Y-m-d'))->where('vege_datum', '>=', $date->format('Y-m-d'));
        }])->firstOrFail();

        $szemelyek = $tanszekek->szemelyek;
        if($szemelyek->isEmpty())
            throw new ModelNotFoundException;

        return $tanszekek->szemelyek;
    }
}