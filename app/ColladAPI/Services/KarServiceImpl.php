<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:22 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Repositories\KarRepository;
use ColladAPI\Services\KarService;
use ColladAPI\Entities\Kar;
use ColladAPI\Services\CRUDServiceImpl;

class KarServiceImpl extends CRUDServiceImpl implements KarService {

    public function __construct(KarRepository $karRepository)
    {
        $this->crudRepository = $karRepository;
    }

    public function save(array $karData)
    {
        $kar = new Kar();
        $kar->fill($karData);
        $kar->validate();

        if (!$kar->save()) {
            throw new ErrorMessageException('Hiba az adatok felvitele során');
            return false;
        }

        return $kar;
    }

    public function szemelyekByIdAndDate($karId, \DateTime $idopont)
    {
        return $this->crudRepository->szemelyekByIdAndDate($karId, $idopont);
    }

    public function intezetekAndTanszekekByIdAndDate($karId, \DateTime $idopont)
    {
        return $this->crudRepository->intezetekAndTanszekekByIdAndDate($karId, $idopont);
    }
}