<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:36 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Entities\TDKDolgozat;
use ColladAPI\Services\TDKDolgozatService;
use ColladAPI\Repositories\TDKDolgozatRepository;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Services\CRUDServiceImpl;

class TDKDolgozatServiceImpl extends CRUDServiceImpl implements TDKDolgozatService {

    public function __construct(TDKDolgozatRepository $tdkDolgozatRepository)
    {
        $this->crudRepository = $tdkDolgozatRepository;
    }

    public function save(array $dolgozatData)
    {
        $tdkDolgozat = new TDKDolgozat();
        $tdkDolgozat->fill($dolgozatData);
        $tdkDolgozat->validate();

        if (!$tdkDolgozat->save()) {
            throw new ErrorMessageException('Hiba az adatok frissítése során');
            return false;
        }

        return $tdkDolgozat;
    }
}