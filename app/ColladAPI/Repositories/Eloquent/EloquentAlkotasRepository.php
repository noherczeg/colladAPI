<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:15 PM
 */

namespace ColladAPI\Repositories\Eloquent;


use ColladAPI\Entities\Alkotas;
use ColladAPI\Repositories\AlkotasRepository;
use ColladAPI\Repositories\Eloquent\EloquentCRUDRepository;

class EloquentAlkotasRepository extends EloquentCRUDRepository implements AlkotasRepository
{

    public function __construct(Alkotas $alkotas)
    {
        parent::__construct($alkotas);
    }

    public function all()
    {
        return $this->entity->with('tipus')->get();
    }

    public function allBetweenDates(\DateTime $from, \DateTime $to)
    {
        return $this->entity->where('datum', '>=', $from->format('Y-m-d'))->where('datum', '<=', $to->format('Y-m-d'))->with('palyazatok', 'szemelyek')->get();
    }

    public function findById($entityId)
    {
        return $this->entity->with('palyazatok')->findOrFail($entityId);
    }
}