<?php namespace ColladAPI\Core\Alkotas;

use Noherczeg\RestExt\Repository\RestExtRepository;

class AlkotasEloquentRepository extends RestExtRepository implements AlkotasRepository
{

    public function __construct(Alkotas $alkotas)
    {
        parent::__construct($alkotas);
    }

    public function allBetweenDates(\DateTime $from, \DateTime $to)
    {
        return $this->entity->where('datum', '>=', $from->format('Y-m-d'))->where('datum', '<=', $to->format('Y-m-d'))->with('palyazatok', 'szemelyek')->get();
    }

    public function findById($entityId)
    {
        return $this->entity->with('palyazatok')->findOrFail($entityId);
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }
}