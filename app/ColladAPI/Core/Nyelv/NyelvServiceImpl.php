<?php namespace ColladAPI\Core\Nyelv;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class NyelvServiceImpl extends CRUDServiceImpl implements NyelvService {

    public function __construct(NyelvRepository $nyelvRepository)
    {
        $this->repository = $nyelvRepository;
    }

}