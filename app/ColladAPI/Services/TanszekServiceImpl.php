<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 11:32 PM
 */

namespace ColladAPI\Services;

use ColladAPI\Entities\Tanszek;
use ColladAPI\Services\TanszekService;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Repositories\TanszekRepository;
use ColladAPI\Services\CRUDServiceImpl;

class TanszekServiceImpl extends CRUDServiceImpl implements TanszekService {

    public function __construct(TanszekRepository $tanszekRepository)
    {
        $this->crudRepository = $tanszekRepository;
    }

    public function save(array $tanszekData)
    {
        $tanszek = new Tanszek();
        $tanszek->fill($tanszekData);
        $tanszek->validate();

        if (!$tanszek->save()) {
            throw new ErrorMessageException('Hiba az adatok mentése közben');
            return false;
        }

        return $tanszek;
    }

    public function szemelyekByDate($tanszekId, \DateTime $date)
    {
        return $this->crudRepository->szemelyekByDate($tanszekId, $date);
    }
}