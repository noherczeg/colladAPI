<?php namespace ColladAPI\Core\Tanulmanyut;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class TanulmanyutServiceImpl extends CRUDServiceImpl implements TanulmanyutService {

    public function __construct(TanulmanyutRepository $tanulmanyutRepository)
    {
        $this->repository = $tanulmanyutRepository;
    }

    public function findByIdWithAll($id)
    {
        return $this->repository->findByIdWithAll($id);
    }
}