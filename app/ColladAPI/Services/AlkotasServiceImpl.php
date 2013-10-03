<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:08 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\AlkotasService;
use ColladAPI\Entities\Alkotas;
use ColladAPI\Repositories\AlkotasRepository;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Services\CRUDServiceImpl;

class AlkotasServiceImpl extends CRUDServiceImpl implements AlkotasService {

    public function __construct(AlkotasRepository $alkotasRepository)
    {
        $this->crudRepository = $alkotasRepository;
    }

    public function save(array $alkotasData)
    {
        $alkotas = new Alkotas();
        $alkotas->fill($alkotasData);
        $alkotas->validate();

        if (!$alkotas->save()) {
            throw new ErrorMessageException('Hiba az adatok felvitele során');
            return false;
        }

        return $alkotas;
    }

}