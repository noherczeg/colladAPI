<?php namespace ColladAPI\Core\Kar;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class KarServiceImpl extends CRUDServiceImpl implements KarService {

    public function __construct(KarRepository $karRepository)
    {
        $this->repository = $karRepository;
    }

    public function szemelyekByIdAndDate($karId, \DateTime $idopont)
    {
        return $this->repository->szemelyekByIdAndDate($karId, $idopont);
    }

    public function intezetekAndTanszekekByIdAndDate($karId, \DateTime $idopont)
    {
        return $this->repository->intezetekAndTanszekekByIdAndDate($karId, $idopont);
    }
}