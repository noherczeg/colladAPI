<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 10:36 PM
 */

namespace ColladAPI\Services;

use ColladAPI\Entities\Palyazat;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Repositories\PalyazatRepository;
use ColladAPI\Services\PalyazatService;
use ColladAPI\Services\CRUDServiceImpl;

class PalyazatServiceImpl extends CRUDServiceImpl implements PalyazatService {

    public function __construct(PalyazatRepository $palyazatRepository)
    {
        $this->crudRepository = $palyazatRepository;
    }

    /**
     * @param array $palyazatData
     * @return bool|Palyazat
     * @throws ErrorMessageException
     */
    public function save(array $palyazatData)
    {
        $palyazat = new Palyazat();
        $palyazat->fill($palyazatData);
        $palyazat->validate();

        if (!$palyazat->save()) {
            throw new ErrorMessageException('Hiba az adatok mentése során');
            return false;
        }

        return $palyazat;
    }
}