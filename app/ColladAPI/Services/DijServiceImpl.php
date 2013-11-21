<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:12 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Repositories\DijRepository;
use ColladAPI\Services\DijService;
use ColladAPI\Services\CRUDServiceImpl;

class DijServiceImpl extends CRUDServiceImpl implements DijService {

    public function __construct(DijRepository $dijRepository)
    {
        $this->repository = $dijRepository;
    }
}