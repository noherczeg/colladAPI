<?php namespace ColladAPI\Core\Tanszek;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class TanszekServiceImpl extends CRUDServiceImpl implements TanszekService {

    public function __construct(TanszekRepository $tanszekRepository)
    {
        $this->repository = $tanszekRepository;
    }

    public function allForSzemely($id)
    {
        return $this->repository->allForSzemely($id);
    }

    public function findByIdWithAll($id)
    {
        return $this->repository->findByIdWithAll($id);
    }
}