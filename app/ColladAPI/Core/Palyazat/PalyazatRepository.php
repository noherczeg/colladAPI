<?php namespace ColladAPI\Core\Palyazat;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface PalyazatRepository extends CRUDRepository {

    public function findByIdWithAll($id);

    public function findPublikacioForPalyazat($palyazatId, $pubId);

    public function findPublikaciokForPalyazat($palyazatId);

}