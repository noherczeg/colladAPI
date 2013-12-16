<?php namespace ColladAPI\Core\Palyazat;

use Noherczeg\RestExt\Repository\RestExtRepository;

class PalyazatEloquentRepository extends RestExtRepository implements PalyazatRepository {

    public function __construct(Palyazat $palyazat)
    {
        $this->entity = $palyazat;
    }

    public function findById($entityId)
    {
        return $this->entity->with('tipus', 'orszag', 'statusz', 'alkotasok', 'szemelyek', 'tudomanyteruletek')->findOrFail($entityId);
    }

    public function findPublikacioForPalyazat($palyazatId, $pubId)
    {
        return $this->entity->with(array('publikaciok' => function($query) use ($pubId) {
            $query->where('publikacio_id', $pubId);
        }))->findOrFail($palyazatId)->publikaciok->first();
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }

    public function findPublikaciokForPalyazat($palyazatId)
    {
        return $this->entity->with('publikaciok')->findOrFail($palyazatId)->publikaciok;
    }
}