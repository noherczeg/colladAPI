<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 10:36 PM
 */

namespace ColladAPI\Services;

use ColladAPI\Repositories\PalyazatRepository;
use ColladAPI\Services\PalyazatService;
use ColladAPI\Services\CRUDServiceImpl;

class PalyazatServiceImpl extends CRUDServiceImpl implements PalyazatService {

    public function __construct(PalyazatRepository $palyazatRepository)
    {
        $this->repository = $palyazatRepository;
    }

}