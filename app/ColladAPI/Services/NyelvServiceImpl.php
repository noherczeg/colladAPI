<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.26.
 * Time: 17:25
 */

namespace ColladAPI\Services;


use ColladAPI\Repositories\NyelvRepository;

class NyelvServiceImpl extends CRUDServiceImpl implements NyelvService {

    public function __construct(NyelvRepository $nyelvRepository)
    {
        $this->repository = $nyelvRepository;
    }

}