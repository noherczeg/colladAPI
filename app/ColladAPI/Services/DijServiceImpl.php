<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:12 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Repositories\DijRepository;
use ColladAPI\Services\DijService;
use ColladAPI\Entities\Dij;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Services\CRUDServiceImpl;

class DijServiceImpl extends CRUDServiceImpl implements DijService {

    public function __construct(DijRepository $dijRepository)
    {
        $this->crudRepository = $dijRepository;
    }

    public function save(array $dijData)
    {
        $dij = new Dij();
        $dij->fill($dijData);
        $dij->validate();

        if (!$dij->save()) {
            throw new ErrorMessageException('Hiba az adatok frissítése során');
            return false;
        }

        return $dij;
    }
}