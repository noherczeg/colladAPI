<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:26 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Entities\Publikacio;
use ColladAPI\Services\PublikacioService;
use ColladAPI\Repositories\PublikacioRepository;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Services\CRUDServiceImpl;

class PublikacioServiceImpl extends CRUDServiceImpl implements PublikacioService {

    public function __construct(PublikacioRepository $publikacioRepository)
    {
        $this->crudRepository = $publikacioRepository;
    }

    public function save(array $publikacioData)
    {
        $publikacio = new Publikacio();
        $publikacio->fill($publikacioData);
        $publikacio->validate();

        if (!$publikacio->save()) {
            throw new ErrorMessageException('Hiba az adatok frissítése során');
            return false;
        }

        return $publikacio;
    }
}