<?php namespace ColladAPI\Services;

use ColladAPI\Repositories\TDKDolgozatRepository;
use ColladAPI\Services\CRUDServiceImpl;

class TDKDolgozatServiceImpl extends CRUDServiceImpl implements TDKDolgozatService {

    public function __construct(TDKDolgozatRepository $tdkDolgozatRepository)
    {
        $this->repository = $tdkDolgozatRepository;
    }

}