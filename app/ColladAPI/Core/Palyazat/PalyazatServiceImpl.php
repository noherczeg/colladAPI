<?php namespace ColladAPI\Core\Palyazat;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class PalyazatServiceImpl extends CRUDServiceImpl implements PalyazatService {

    public function __construct(PalyazatRepository $palyazatRepository)
    {
        $this->repository = $palyazatRepository;
    }

}