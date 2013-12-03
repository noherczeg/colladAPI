<?php namespace ColladAPI\Core\Fokozat;

use ColladAPI\Core\Rest\CRUDService;

interface FokozatService extends CRUDService {

    public function allForSzemely($id);

} 