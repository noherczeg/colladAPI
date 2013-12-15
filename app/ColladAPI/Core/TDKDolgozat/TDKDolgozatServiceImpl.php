<?php namespace ColladAPI\Core\TDKDolgozat;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class TDKDolgozatServiceImpl extends CRUDServiceImpl implements TDKDolgozatService {

    public function __construct(TDKDolgozatRepository $tdkDolgozatRepository)
    {
        $this->repository = $tdkDolgozatRepository;
    }

    public function findByIdWithAll($id)
    {
        return $this->repository->findByIdWithAll($id);
    }
}