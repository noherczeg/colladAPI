<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.27.
 * Time: 1:07
 */

namespace ColladAPI\Services;


use ColladAPI\Repositories\SzerepkorRepository;

class SzerepkorServiceImpl extends CRUDServiceImpl implements SzerepkorService {

    public function __construct(SzerepkorRepository $szerepkorRepository)
    {
        $this->repository = $szerepkorRepository;
    }

}