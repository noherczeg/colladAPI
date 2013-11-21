<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:26 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\PublikacioService;
use ColladAPI\Repositories\PublikacioRepository;
use ColladAPI\Services\CRUDServiceImpl;

class PublikacioServiceImpl extends CRUDServiceImpl implements PublikacioService {

    public function __construct(PublikacioRepository $publikacioRepository)
    {
        $this->repository = $publikacioRepository;
    }

}