<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:31 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\TanulmanyutService;
use ColladAPI\Repositories\TanulmanyutRepository;
use ColladAPI\Services\CRUDServiceImpl;

class TanulmanyutServiceImpl extends CRUDServiceImpl implements TanulmanyutService {

    public function __construct(TanulmanyutRepository $tanulmanyutRepository)
    {
        $this->repository = $tanulmanyutRepository;
    }

}