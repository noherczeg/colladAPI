<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 11:32 PM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\TanszekService;
use ColladAPI\Repositories\TanszekRepository;
use ColladAPI\Services\CRUDServiceImpl;

class TanszekServiceImpl extends CRUDServiceImpl implements TanszekService {

    public function __construct(TanszekRepository $tanszekRepository)
    {
        $this->repository = $tanszekRepository;
    }

    public function szemelyekByDate($tanszekId, \DateTime $date)
    {
        return $this->repository->szemelyekByDate($tanszekId, $date);
    }
}