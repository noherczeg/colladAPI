<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:08 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\AlkotasService;
use ColladAPI\Repositories\AlkotasRepository;
use ColladAPI\Services\CRUDServiceImpl;

class AlkotasServiceImpl extends CRUDServiceImpl implements AlkotasService {

    public function __construct(AlkotasRepository $alkotasRepository)
    {
        $this->repository = $alkotasRepository;
    }
    
    public function allBetweenDates(\DateTime $from, \DateTime $to)
    {
        return $this->repository->allBetweenDates($from, $to);
    }

}