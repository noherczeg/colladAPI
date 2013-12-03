<?php namespace ColladAPI\Core\Szervezet;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class SzervezetServiceImpl extends CRUDServiceImpl implements SzervezetService {

    public function __construct(SzervezetRepository $repo)
    {
        $this->repository = $repo;
    }

    public function findByIdWithAll($szervezetId)
    {
        return $this->repository->findByIdWithAll($szervezetId);
    }
}