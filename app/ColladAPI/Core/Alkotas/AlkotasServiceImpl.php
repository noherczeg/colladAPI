<?php namespace ColladAPI\Core\Alkotas;

use ColladAPI\Core\Rest\CRUDServiceImpl;

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