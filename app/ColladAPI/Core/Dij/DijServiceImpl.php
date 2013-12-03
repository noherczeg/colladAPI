<?php namespace ColladAPI\Core\Dij;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class DijServiceImpl extends CRUDServiceImpl implements DijService {

    public function __construct(DijRepository $dijRepository)
    {
        $this->repository = $dijRepository;
    }
}