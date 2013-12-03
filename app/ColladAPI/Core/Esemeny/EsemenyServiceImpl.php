<?php namespace ColladAPI\Core\Esemeny;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class EsemenyServiceImpl extends CRUDServiceImpl implements EsemenyService {

    public function __construct(EsemenyRepository $esemenyRepository)
    {
        $this->repository = $esemenyRepository;
    }
}