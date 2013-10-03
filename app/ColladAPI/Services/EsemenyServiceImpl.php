<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:19 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Entities\Esemeny;
use ColladAPI\Repositories\EsemenyRepository;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Services\CRUDServiceImpl;

class EsemenyServiceImpl extends CRUDServiceImpl implements EsemenyService {

    public function __construct(EsemenyRepository $esemenyRepository)
    {
        $this->crudRepository = $esemenyRepository;
    }

    public function save(array $esemenyData)
    {
        $esemeny = new Esemeny();
        $esemeny->fill($esemenyData);
        $esemeny->validate();

        if (!$esemeny->save()) {
            throw new ErrorMessageException('Hiba az adatok felvitele során');
            return false;
        }

        return $esemeny;
    }
}