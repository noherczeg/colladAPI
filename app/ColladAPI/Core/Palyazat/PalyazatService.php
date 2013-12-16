<?php namespace ColladAPI\Core\Palyazat;

use ColladAPI\Core\Rest\CRUDService;

interface PalyazatService extends CRUDService {

    public function findByIdWithAll($id);

    public function findPublikacioForPalyazat($palyazatId, $pubId);

    public function findPublikaciokForPalyazat($palyazatId);

}