<?php namespace ColladAPI\Core\Szerepkor;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class SzerepkorServiceImpl extends CRUDServiceImpl implements SzerepkorService {

    public function __construct(SzerepkorRepository $szerepkorRepository)
    {
        $this->repository = $szerepkorRepository;
    }

    public function findByIdWithAll($szerepkorId)
    {
        return $this->repository->findByIdWithAll($szerepkorId);
    }
}