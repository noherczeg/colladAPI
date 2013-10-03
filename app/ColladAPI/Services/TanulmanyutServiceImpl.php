<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:31 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Entities\Tanulmanyut;
use ColladAPI\Services\TanulmanyutService;
use ColladAPI\Repositories\TanulmanyutRepository;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Services\CRUDServiceImpl;

class TanulmanyutServiceImpl extends CRUDServiceImpl implements TanulmanyutService {

    public function __construct(TanulmanyutRepository $tanulmanyutRepository)
    {
        $this->crudRepository = $tanulmanyutRepository;
    }

    public function save(array $tanulmanyutData)
    {
        $tanulmanyut = new Tanulmanyut();
        $tanulmanyut->fill($tanulmanyutData);
        $tanulmanyut->validate();

        if (!$tanulmanyut->save()) {
            throw new ErrorMessageException('Hiba az adatok frissítése során');
            return false;
        }

        return $tanulmanyut;
    }
}