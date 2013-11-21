<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:19 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Repositories\EsemenyRepository;
use ColladAPI\Services\CRUDServiceImpl;

class EsemenyServiceImpl extends CRUDServiceImpl implements EsemenyService {

    public function __construct(EsemenyRepository $esemenyRepository)
    {
        $this->repository = $esemenyRepository;
    }
}