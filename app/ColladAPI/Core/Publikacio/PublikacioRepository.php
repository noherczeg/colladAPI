<?php namespace ColladAPI\Core\Publikacio;

use ColladAPI\Core\Nyelv\Nyelv;
use Noherczeg\RestExt\Repository\CRUDRepository;

interface PublikacioRepository extends CRUDRepository {

    public function findByIdWithAll($id);

    public function findNyelvForPublikacio($pubId, $nyelvId);

    public function addNyelvForPublikacio($pubId, Nyelv $nyelv);

}