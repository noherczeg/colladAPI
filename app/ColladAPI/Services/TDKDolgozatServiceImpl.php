<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:36 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\TDKDolgozatService;
use ColladAPI\Repositories\TDKDolgozatRepository;
use ColladAPI\Services\CRUDServiceImpl;

class TDKDolgozatServiceImpl extends CRUDServiceImpl implements TDKDolgozatService {

    public function __construct(TDKDolgozatRepository $tdkDolgozatRepository)
    {
        $this->repository = $tdkDolgozatRepository;
    }

}