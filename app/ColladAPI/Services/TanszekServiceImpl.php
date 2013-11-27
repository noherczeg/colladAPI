<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 11:32 PM
 */

namespace ColladAPI\Services;

use ColladAPI\Repositories\TanszekRepository;

class TanszekServiceImpl extends CRUDServiceImpl implements TanszekService {

    public function __construct(TanszekRepository $tanszekRepository)
    {
        $this->repository = $tanszekRepository;
    }

    public function allForSzemely($id)
    {
        return $this->repository->allForSzemely($id);
    }
}