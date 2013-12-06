<?php namespace ColladAPI\Core\Publikacio;

use ColladAPI\Core\Nyelv\Nyelv;
use Illuminate\Database\Eloquent\Model;
use Noherczeg\RestExt\Repository\RestExtRepository;

class PublikacioEloquentRepository extends RestExtRepository implements PublikacioRepository {

    public function __construct(Publikacio $entity)
    {
        parent::__construct($entity);
    }

    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }

    public function findNyelvForPublikacio($pubId, $nyelvId)
    {
        return $this->entity->findOrFail($pubId)->nyelv()->findOrFail($nyelvId);
    }

    public function addNyelvForPublikacio($pubId, Nyelv $nyelv)
    {
        $pub = $this->entity->findOrFail($pubId);
        $pub->nyelv()->associate($nyelv);

        return $pub->save();
    }
}