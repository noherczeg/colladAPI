<?php namespace ColladAPI\Core\Publikacio;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class PublikacioServiceImpl extends CRUDServiceImpl implements PublikacioService {

    public function __construct(PublikacioRepository $publikacioRepository)
    {
        $this->repository = $publikacioRepository;
    }

}